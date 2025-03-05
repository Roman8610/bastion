<?php
namespace app\commands;

use app\modules\admin\models\ImportStatistics;
use Exception;
use PDO;
use PDOException;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use XMLReader;
use Yii;
use yii\console\Controller;

class ImportGuiController extends Controller
{
    public $pdo;

    public $dir_image = null;

    public $result = [
        'status' => 'stopped',
        'addCat' => 0,
        'skippedCat' => 0,
        'addProd' => 0,
        'skippedProd' => 0,
    ];

    public $path_file = '/web/importfiles/import1.xml';

    public function actionIndex()
    {

        $this->path_file = $this->getPathFile();

        $this->result['status'] = 'run';

        $this->importCat();
        
        $this->importProd();

        $this->result['status'] = 'stopped';

        $this->writeJson();

        $this->saveResultImport();

    }

    private function fillProd($filePath)
    {
        $xml = new \XMLReader();
        $xml->open($filePath);

        // Читаем <offer> элементы
        while ($xml->read() && $xml->name !== 'offer') {
        }

        while ($xml->name === 'offer') {
            $product = simplexml_load_string($xml->readOuterXML());

            if ($this->unickProd($product->attributes()->id) === 0) {

                $id_import = $product->attributes()->id;
                $category_id = $product->categoryId;
                $alias = $this->getAliasProd($product->name);

                if (!$alias) {
                    $xml->next('offer');
                    continue;
                }

                $title = $product->name;
                $description = $product->description;

                $article = $product->vendorCode;

                //$img = $this->saveImage($product->picture);

                $img = null;

                $brand_id = 1;

                $sql = "INSERT INTO product (`id_import`, `category_id`, `alias`, `title`, `description`, `article`, `img`, `brand_id`) 
                        VALUES (:id_import, :category_id, :alias, :title, :description, :article, :img, :brand_id)";
                
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam(':id_import', $id_import, PDO::PARAM_INT);
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
                $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':article', $article, PDO::PARAM_STR);
                $stmt->bindParam(':img', $img, PDO::PARAM_STR);
                $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);

                if($stmt->execute())
                {
                    $this->result['addProd']++;
                    $this->writeJson();
                }

                $this->saveParam($this->pdo->lastInsertId(), $product->param);

            }else{
                $this->result['skippedProd']++;
                $this->writeJson();
            }

            $xml->next('offer'); // Переход к следующему элементу

        }

        // Закрываем XMLReader для каждого файла
        $xml->close();

        // Явно вызываем сборщик мусора
        gc_collect_cycles();

        // Логируем использование памяти
        $pathRoot = Yii::getAlias('@app');
        $fl = fopen($pathRoot . '/web/importfiles/temp/logs/logs.txt', 'a');
        fwrite($fl, memory_get_usage() . " байт \n");
        fclose($fl);           
    }

    private function unickProd($id_import)
    {
        if(!($this->pdo instanceof PDO))
        {
            $this->connectDB();
        }

        $category_count = $this->pdo->query("SELECT COUNT(*) FROM product WHERE id_import = $id_import")->fetchColumn();

        return $category_count;
    }

    private function unickCat($id_import)
    {
        if(!($this->pdo instanceof PDO))
        {
            $this->connectDB();
        }

        $category_count = $this->pdo->query("SELECT COUNT(*) FROM category WHERE id_import = $id_import")->fetchColumn();

        return $category_count;
    }

    private function saveParam($prod_id, $params)
    {
        try {

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->beginTransaction();

            $sql_attr_group = "INSERT INTO attr_group (`title`) VALUES (:title)";

            $sql_attr_value = "INSERT INTO attr_value (`value`, `attr_group_id`) VALUES (:value, :attr_group_id)";

            $sql_attr_prod = "INSERT INTO attr_prod (`attr_id`, `product_id`) VALUES (:attr_id, :product_id)";

            $stmt_attr_group = $this->pdo->prepare($sql_attr_group);

            $stmt_attr_value = $this->pdo->prepare($sql_attr_value);

            $stmt_attr_prod = $this->pdo->prepare($sql_attr_prod);

            foreach($params as $param)
            {
                if((string)$param->attributes()->name != 'Документы')
                {
                    $stmt_attr_group->execute(['title' => (string)$param->attributes()->name]);

                    $stmt_attr_value->execute(['value' => (string)$param, 'attr_group_id' => $this->pdo->lastInsertId()]);
    
                    $stmt_attr_prod->execute(['attr_id' => $this->pdo->lastInsertId(), 'product_id' => $prod_id]);
                }
                else
                {
                   // $this->saveDocs($prod_id, (string)$param);
                }

            }

            $this->pdo->commit();

        }
        catch(PDOException $e)
        {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            echo "Ошибка: " . $e->getMessage();
        }

        return true;
    }

    private function getAliasProd($value)
    {
        if($value)
        {
            $converter = array(
                'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
                'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
                'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
                'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
                'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
                'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
                'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
            );
         
            $value = mb_strtolower($value);
            $value = strtr($value, $converter);
            $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
            $value = mb_ereg_replace('[-]+', '-', $value);
            $value = trim($value, '-');	
            $value = $this->checkUnique($value, 1);
            return $value;
        }
        else
        {
            return null;
        }
    }

    private function getAliasCat($value)
    {
        if($value)
        {
            $converter = array(
                'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
                'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
                'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
                'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
                'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
                'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
                'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
            );
         
            $value = mb_strtolower($value);
            $value = strtr($value, $converter);
            $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
            $value = mb_ereg_replace('[-]+', '-', $value);
            $value = trim($value, '-');	
            $value = $this->checkUniqueCat($value, 1);
            return $value;
        }
        else
        {
            return null;
        }
    }

    private function checkUnique($value, $i = 1)
    {       
        if(!$this->pdo->query("SELECT COUNT(*) FROM product WHERE alias = '".$value."'")->fetchColumn()){
                return $value;
           } 
        else 
           {
                $value .= "-$i";
                $i++;
                $value = $this->checkUnique($value, $i);
           }
        return $value;
    }

    private function checkUniqueCat($value, $i = 1)
    {       
        if(!$this->pdo->query("SELECT COUNT(*) FROM category WHERE alias = '".$value."'")->fetchColumn()){
                return $value;
           } 
        else 
           {
                $value .= "-$i";
                $i++;
                $value = $this->checkUnique($value, $i);
           }
        return $value;
    }

    public function connectDB()
    {
        $dsn = 'mysql:host=mysql;dbname=bastion3;charset=utf8mb4';
        $user = 'root';
        $password = '6b_ecXVu3Z';

        $this->pdo = new PDO($dsn, $user, $password);
    }

    public function importProd()
    {

        // $output = new ConsoleOutput();
        // $progessBar = new ProgressBar($output);
        // $progessBar->setFormat('debug');
        // $progessBar->start();

        try{
            $xml = XMLReader::open($this->path_file);
        }catch(\Exception $e){
           // echo 'Ошибка: ',  $e->getMessage(), "<br>";
        }

        while ($xml->read() && $xml->name !== 'offer') {
        } //jump to first `room` element;

        $maxElementsPerPart = 500;

        $currentIndex = 0;

        $currentPart = 0;

        $pathRoot = Yii::getAlias('@app');

        $partFilename = $pathRoot .'/web/importfiles/temp/part' . ($currentPart + 1) . '.xml';
        try{
            $fp = fopen($partFilename, 'w');
        }catch(\Exception $e){
           // echo 'Ошибка: ',  $e->getMessage(), "<br>";
        }

        fwrite($fp, '<offers>');

        while ($xml->next('offer')){
            $full = false;
            if ($currentIndex % $maxElementsPerPart == 0 && $currentIndex > 0 ) {

                fwrite($fp, '</offers>');

                $full = true;

                fclose($fp);

                $this->fillProd($partFilename);
              
                $currentPart++;

                $pathRoot = Yii::getAlias('@app');

                $partFilename = $pathRoot .'/web/importfiles/temp/part' . ($currentPart + 1) . '.xml';

                try{
                    $fp = fopen($partFilename, 'w');
                }catch(\Exception $e){
                    //echo 'Ошибка: ',  $e->getMessage(), "<br>";
                }

                fwrite($fp, '<offers>');
            }

            $xml1 = simplexml_load_string($xml->readOuterXML());

            $xml1->description = htmlspecialchars($xml1->description);

            $xml1->name = htmlspecialchars($xml1->name);

            $str = str_replace('<?xml version="1.0"?>',"",html_entity_decode($xml1->asXML(),ENT_NOQUOTES, 'UTF-8'));
            $srt = str_replace('&', '&amp;', $str);
            fwrite($fp, $srt);

        //    $progessBar->advance();

            $currentIndex++;
        }

        if($full) {
            fwrite($fp, '</offers>');
            fclose($fp);
            $this->fillProd($partFilename);
        }
        

       // $progessBar->finish();

      //  $output->writeln('');
    }

    public function importCat()
    {
        // echo "OK "; die;
        // $output = new ConsoleOutput();
        // $progessBar = new ProgressBar($output);
        // $progessBar->setFormat('debug');
        // $progessBar->start();

        try{
            $xml = XMLReader::open($this->path_file);
        }catch(\Exception $e){
            echo 'Ошибка: ',  $e->getMessage(), "<br>";
        }

       
        while ($xml->read() && $xml->name !== 'category') {
        } //jump to first `room` element;

        while ($xml->name === 'category') {
            $category = simplexml_load_string($xml->readOuterXML());

            if ($this->unickCat($category->attributes()->id) === 0) {

                $id_import = $category->attributes()->id;

                if(isset($category->attributes()->parentId))
                {
                    $parent_id = $category->attributes()->parentId;
                }
                else
                {
                    $parent_id = 0;
                }
                
                $alias = $this->getAliasCat($category);

                if (!$alias) {
                    $xml->next('category');
                    continue;
                }

                $title = $category;
                $priority = 0;

                $sql = "INSERT INTO category (`id_import`, `parent_id`, `title`, `alias`, `priority`) 
                        VALUES (:id_import, :parent_id, :title, :alias, :priority)";
                
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam(':id_import', $id_import, PDO::PARAM_INT);
                $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
                $stmt->bindParam(':priority', $priority, PDO::PARAM_INT);

                if($stmt->execute())
                {
                    $this->result['addCat']++;
                    $this->writeJson();
                }


            }
            else
            {
                $this->result['skippedCat']++;
                $this->writeJson();
            }

            $xml->next('category'); // Переход к следующему элементу

        }

       // $progessBar->advance();

    }

    public function saveDocs($prod_id, $doc_path)
    {

        $file_content = file_get_contents($doc_path);

        if ($file_content !== false)
        {

            $dir = 'web/docs/DOC'.$prod_id;

            if(!file_exists($dir))
            {
                mkdir($dir, 0755, true);
            }

            $path_file = $dir.'/'.basename($doc_path);

            if(file_put_contents($path_file, $file_content))
            {
                $sql = "INSERT INTO docs_prod (`prod_id`, `path_doc`) VALUES (:prod_id, :path_doc)";
                
                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
                $stmt->bindParam(':path_doc', $path_file, PDO::PARAM_STR);

                $stmt->execute();
            }
        } 
        else 
        {
            echo "Ошибка при загрузке файла.";
        }
    }

    public function saveImage($path_image)
    {
        $file_content = file_get_contents($path_image);

        if ($file_content !== false)
        {
            $dir = $this->getDirProd();

            $path_file = $dir.'/'.basename($path_image);

            if(file_put_contents($path_file, $file_content))
            {
               return $path_file;
            }
            else
            {
                return null;
            }
        } 
        else 
        {
            echo "Ошибка при загрузке файла.";
        }
    }

    public function getDirProd($postfix = 1)
    {
        if($this->dir_image === null || $this->qtyDir($this->dir_image) >= 500)
        {

            $dir = 'web/images/product/img'.random_int(10000000, 99999999);

            if(!is_dir($dir))
            {
                mkdir($dir, 0755, true);
                $this->dir_image = $dir;
                return $dir;
            }
            else
            {
                $dir = $dir.'-'.$postfix;
                $postfix++;
                $this->getDirProd($postfix);
            }

        }
        else
        {
            return $this->dir_image;
        }
    }

    public function qtyDir($dir)
    {
        $files = scandir($dir);
        $count = count($files) - 2;
        return $count;
    }

    public function getPathFile()
    {
        $root = Yii::getAlias('@app');
        return $root . $this->path_file;
    }

    public function writeJson()
    {
        $jsonData = json_encode($this->result);

        $filePath = 'import.json';

        file_put_contents($filePath, $jsonData);
    }

    public function saveResultImport()
    {
        $data = $this->result;

        $importStatistics = new ImportStatistics();

        $importStatistics->add_cat = $data['addCat'];
        $importStatistics->skipped_cat = $data['skippedCat'];
        $importStatistics->add_prod = $data['addProd'];
        $importStatistics->skipped_prod = $data['skippedProd'];

        try{

            $importStatistics->save();

        }catch(\Exception $e){
            $error = 'Ошибка: ' .  $e->getMessage() . "\n";

            file_put_contents('import.log', $error);
        }
        

    }


 

}