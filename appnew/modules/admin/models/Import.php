<?php
namespace app\modules\admin\models;

use yii\base\Model;

class Import extends Model
{

    public $file;

    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Загрузите XML файл'
        ];
    }

}

