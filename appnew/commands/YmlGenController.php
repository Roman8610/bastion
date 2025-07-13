<?php
namespace app\commands;

use app\models\Category;
use app\models\Product;
use PDO;
use Yii;
use yii\console\Controller;
use yii\data\Pagination;

class YmlGenController extends Controller
{

    public $pdo;

    public function actionIndex()
    {

    //    $this->connectDB();

        $folderPath = Yii::getAlias('@web') . '/web/yml/feed.yml';

        $data = '<?xml version="1.0" encoding="UTF-8"?>'."\n"."\t".'<yml_catalog date="'. date('Y-m-d H:i:s').'">'."\n\t<shop>\n\t\t";

        $data .= "<name>Бастион ИТ</name>\n\t\t<company>Бастион ИТ</company>\n\t\t<url>https://bastionit.ru/</url>\n\t";

        $data .= $this->getData();

        $data .= "</shop>\n</yml_catalog>";

        if(file_put_contents($folderPath, $data)) {
                    echo "Данные успешно записаны в файл.";
        } else {
                    echo "Ошибка записи в файл.";
        }


    }

    public function getData()
    {
        $cat = "<categories>\n\t";

        $prod = '';

        $products = Product::find()->limit(500)->all();

        foreach($products as $prod)
        {
            $cat .= "<category id=" . $prod->category->id . ">" .$prod->category->title. "</category>\n\t";

          // var_dump($prod->category->title); die;
        }

       return $cat;
    }


    // public function getCat($id)
    // {
    //     $cat = Category::find()->where(['id' => $id])->one();

    //     $str_xml = 

    //     return $str_xml;
    // }



 

    // public function connectDB()
    // {
    //     $dsn = 'mysql:host=mysql;dbname=bastion1;charset=utf8mb4';
    //     $user = 'root';
    //     $password = '6b_ecXVu3Z';

    //     $this->pdo = new PDO($dsn, $user, $password);
    // }

}