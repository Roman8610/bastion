<?php
namespace app\commands;

use app\models\Product;
use Exception;
use Yii;
use yii\console\Controller;

class ExportController extends Controller
{

    public $path;
    public $size_file;
    public $step_size;

    public $dir_name;


    public function actionIndex($path = null, $size_file = null, $step_size = null)
    {

        $this->dir_name = Yii::getAlias('@app/web/exportfiles/');

        if($path === null)
        {
            $path = $this->uniqueName('catalog');
        }

        var_dump($path);
        var_dump($size_file);
        var_dump($step_size);

    }

    public function getProd()
    {

    }

    public function writeCsv()
    {

    }

    public function checkSizeCsv()
    {

    }

    public function uniqueName($name, $i=0)
    {
        if($i==0)
        {
            $path = $this->dir_name . '/' . $name . '.csv';
        }
        else
        {
            $path = $this->dir_name . '/' . $name . '-' . $i . '.csv';
        }

        if (file_exists($path)) {
            $i++;
            $this->uniqueName($name, $i);
        } else {
           return $name;
        }
    }

}

// class ExportController extends Controller
// {
//     public $id;

//     public function actionIndex()
//     {

//         $this->idInit();

//         $mark = $this->id;

//         $step = 10;

//         $path = Yii::getAlias('@app/web/exportfiles/catalog.csv');

//         $sql = 'SELECT `title` AS `Наименование`, `description` AS `Описание`,  `alias` AS `Ссылка на карточку товара` FROM product WHERE `id` > :mark LIMIT :step';

//         $command = Yii::$app->db->createCommand($sql);

//         $command->bindValue(':mark', $mark);
//         $command->bindValue(':step', $step);

//         $data = $command->queryAll();

//         $fp = fopen($path, 'w');

//         fwrite($fp, "\xEF\xBB\xBF");

//         fputcsv($fp, array_keys($data[0]), ';');

//         foreach ($data as $row) {
//             $row['Ссылка на карточку товара'] = 'https://bastionit.ru/product/' . $row['Ссылка на карточку товара'];
//             fputcsv($fp, $row, ';');
//         }

//         fclose($fp);

//     }

//     public function idInit()
//     {
//         $path_mark = Yii::getAlias('@app/web/exportfiles/mark.txt');
//         if((int) file_get_contents($path_mark))
//         {
//             $this->id = (int) file_get_contents($path_mark);
//         }
//         else
//         {
//             $this->id = 0;
//         }
//     }
// }
