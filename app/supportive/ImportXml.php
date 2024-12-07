<?php 
namespace app\supportive;

use app\models\AttrGroup;
use app\models\AttrProd;
use app\models\AttrValue;
use app\models\Product;
use Yii;

class ImportXml 
{
    public function __construct($filePath)
    {
        $this->fillDbForFile($filePath);
    }

    public function fillDbForFile($filePath)
    {
        //   $data = simplexml_load_file($filePath);

        $xml = new \XMLReader();
        $xml->open($filePath);
    
        $iprod = 0;


        // Читаем <offer> элементы
        while ($xml->read() && $xml->name !== 'offer') {
        }

        while ($xml->name === 'offer') {
            $product = simplexml_load_string($xml->readOuterXML());

            if ($this->unickCat($product->attributes()->id, 'app\models\Product') === 0) {
                $model_prod = new Product();
                $model_prod->id_import = $product->attributes()->id;
                $model_prod->category_id = $product->categoryId;
                $model_prod->alias = $this->getAlias($product->name, 'app\models\Product');
                if (!$model_prod->alias) {
                    $xml->next('offer');
                    continue;
                }

                $model_prod->title = $product->name;
                $model_prod->description = $product->description;
                $model_prod->brand_id = 1;

                $transaction = Yii::$app->getDb()->beginTransaction();

                if (!$model_prod->save() || !$this->saveParam($model_prod->id, $product->param)) 
                {
                    $transaction->rollBack();
                } else {
                    $transaction->commit();
                    $iprod++;
                    echo "Добавлено товаров: $iprod  \r\n Обрабатывается файл: $filePath";
                }
                unset($model_prod);
            }

        $xml->next('offer'); // Переход к следующему элементу
    }

    // Закрываем XMLReader для каждого файла
    $xml->close();

    // Явно вызываем сборщик мусора
    gc_collect_cycles();

    // Логируем использование памяти
    $fl = fopen('web/importfiles/temp/logs/logs.txt', 'a');
    fwrite($fl, memory_get_usage() . " байт \n");
    fclose($fl);           

    }

    public function unickCat($id_import, $class_model)
    {
        $id_import = (int)$id_import;
        $category_count = $class_model::find()->where(['id_import' => $id_import])->count();
        return $category_count;
    }

    public function saveParam($prod_id, $params){

        foreach($params as $param)
        {
            $model_attr_group = new AttrGroup();
            $model_attr_group->title = (string)$param->attributes()->name;
    

            if($model_attr_group->title != "Склад «ЧИП и ДИП»" && 
                $model_attr_group->title != "Магазин «ЧИП и ДИП»" &&
                $model_attr_group->title != "Курьер от 2 часов" &&
                $model_attr_group->title != "Курьер" &&
                $model_attr_group->title != "ПВЗ СДЭК" &&
                $model_attr_group->title != "ПВЗ Boxberry" &&
                $model_attr_group->title != "ПВЗ 5Post" &&
                $model_attr_group->title != "ПВЗ Яндекс Доставка" &&
                $model_attr_group->title != "ТК DPD" &&
                $model_attr_group->title != "ТК «Деловые линии»"&&
                $model_attr_group->title != "Документы")
            {

                    if(!$model_attr_group->save())
                    {
                        return false;
                    }

                    $model_attr_value = new AttrValue();
                    $model_attr_value->value = (string)$param;
                    $model_attr_value->attr_group_id = $model_attr_group->id;

                    if(!$model_attr_value->save())
                    {
                        return false;
                    }

                    $group_id = $model_attr_group->id;

                    $model_attr_prod = new AttrProd();
                    $model_attr_prod->attr_id = $model_attr_value->id;
                    $model_attr_prod->product_id = $prod_id;


                    if(!$model_attr_prod->save())
                    {
                        return false;
                    }               

            }

            if(isset($model_attr_group)) unset($model_attr_group);
            if(isset($model_attr_value)) unset($model_attr_value);
            if(isset($model_attr_prod)) unset($model_attr_prod);
        }

        return true;

    }

    public function getAlias($value, $class_model)
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
            $value = $this->checkUnique($value, 1, $class_model);
            return $value;
        }
        else
        {
            return null;
        }
    }

    public function checkUnique($value, $i = 1, $class_model = null)
    {
        if($class_model)
        {
            if(!$class_model::find()->where(['alias' => $value])->count()){
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
    }
}