<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class ExportController extends Controller
{

    public function actionIndex()
    {

        $path = Yii::getAlias('@app/web/exportfiles/catalog.csv');

        //$file_name = 'catalog.csv';

        //file_put_contents($path, '!');

        // Данные для записи в CSV
        $data = [
            ['name' => 'Иван', 'age' => 25],
            ['name' => 'Марина', 'age' => 30]
        ];

        // Открываем файл для записи (или создаем новый)
        $fp = fopen($path, 'w');

        // Установка кодировки файла в UTF-8 BOM
        fwrite($fp, "\xEF\xBB\xBF");

        // Запись заголовков столбцов
        fputcsv($fp, array_keys($data[0]));

        // Запись каждой строки данных
        foreach ($data as $row) {
            fputcsv($fp, $row);
        }

        // Закрытие файла
        fclose($fp);

    }

}