<?php
namespace app\commands;

use yii\console\Controller;

class ImportController_bak extends Controller
{

    public function actionIndex()
    {
        ini_set('memory_limit', '1000M');

        $xml = simplexml_load_file('web/importfiles/import.xml');

        $maxElementsPerPart = 500;

        $currentIndex = 0;

        $currentPart = 0;

        $partFilename = 'web/importfiles/temp/part' . ($currentPart + 1) . '.xml';
        $fp = fopen($partFilename, 'w');

        foreach ($xml->shop->offers->offer as $node) {
            if ($currentIndex % $maxElementsPerPart == 0 && $currentIndex > 0) {

                fclose($fp);

                $currentPart++;

                $partFilename = 'web/importfiles/temp/part' . ($currentPart + 1) . '.xml';
                $fp = fopen($partFilename, 'w');
            }

            fwrite($fp, $node->asXML());
            echo "Добавлено категорий: $currentIndex  \r";

            $currentIndex++;
        }

        fclose($fp);

    }

}