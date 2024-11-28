<?php
namespace app\commands;

use XMLReader;
use yii\console\Controller;

class ImportController extends Controller
{

    public function actionIndex()
    {
        ini_set('memory_limit', '1000M');

        $xml = XMLReader::open('web/importfiles/import.xml');

        while ($xml->read() && $xml->name !== 'offer') {
        } //jump to first `room` element;

        $maxElementsPerPart = 500;

        $currentIndex = 0;

        $currentPart = 0;

        $partFilename = 'web/importfiles/temp/part' . ($currentPart + 1) . '.xml';
        $fp = fopen($partFilename, 'w');

        while ($xml->next('offer')){
            if ($currentIndex % $maxElementsPerPart == 0 && $currentIndex > 0) {

                fclose($fp);

                $currentPart++;

                $partFilename = 'web/importfiles/temp/part' . ($currentPart + 1) . '.xml';
                $fp = fopen($partFilename, 'w');
            }
            $xml1 = simplexml_load_string($xml->readOuterXML());
            fwrite($fp, str_replace('<?xml version="1.0"?>',"",html_entity_decode($xml1->asXML(),ENT_NOQUOTES, 'UTF-8')));
            echo "Добавлено категорий: $currentIndex  \r";

            $currentIndex++;
        }

        fclose($fp);

    }



}