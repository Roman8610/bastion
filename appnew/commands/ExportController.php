<?php
namespace app\commands;

use app\models\Category;
use app\models\Product;
use Exception;
use Yii;
use yii\console\Controller;
use yii\db\Query;

class ExportController extends Controller
{

    public function actionIndex()
    {

        $arr_id = Category::getAllDescendantIds(1424521886);

        $count = Product::find()->where(['category_id' => $arr_id])->count();

        if($count > 200000)
        {
            $count = 200000;
        }

        $pages = ceil($count/1000);

        for($i = 0; $i < $pages; $i++)
        {
            $offset = $i * 1000;

            $products  = Product::find()->select([
                'id',
                'title AS `Наименование`',
                'description AS `Описание`',
                'alias AS `Ссылка на карточку товара`',
            ])->where(['category_id' => $arr_id])->offset($offset)->limit(1000)->asArray()->all(); 


           // print_r($products); die;

            if(!empty($products))
            {
                $path = $this->getPath();

                $this->writeFile($products, $path);
            }





        //die;

        // $count = Product::find()->count();

        // $pages = ceil($count/1000);

        // for($i = 0; $i < $pages; $i++)
        // {
        //     $offset = $i * 1000;

        //     $products  = Product::find()->select([
        //         'id',
        //         'title AS `Наименование`',
        //         'description AS `Описание`',
        //         'alias AS `Ссылка на карточку товара`',
        //     ])->offset($offset)->limit(1000)->asArray()->all(); 

        //     $path = $this->getPath();

        //     $this->writeFile($products, $path);

           // if($i == 5) break;
           //echo "Идет запись файла $i";
        }
    }

    public function getPath()
    {

        $base_name = 'catalog';

        $path = Yii::getAlias('@app/web/exportfiles/'.$base_name . '.csv');

        $i = 0;

        while($this->checkFile($path))
        {
            $i++;
            $path = Yii::getAlias('@app/web/exportfiles/'.$base_name . (string)$i . '.csv');
        }

        return $path;

    }

    public function checkFile($path)
    {

         if(!file_exists($path))
         {
            return false;
         }

         if(filesize($path) > 50000000)
         {
            return true;
         }
         return false;

    }

    public function writeFile($products, $path)
    {

        $fp = fopen($path, 'a');

        if (filesize($path) === 0)
        {
            fwrite($fp, "\xEF\xBB\xBF");
            fputcsv($fp, array_keys($products[0]), ';');
        }

        foreach ($products as $prod)
        {
            $prod['Ссылка на карточку товара'] = 'https://bastionit.ru/product/' . $prod['Ссылка на карточку товара'];
            $prod['Описание'] = '"' . str_replace(array("\r\n", "\r", "\n"), '', $prod['Описание']). '"';
            fputcsv($fp, $prod, ';');
        }

        fclose($fp);

    }

   


}