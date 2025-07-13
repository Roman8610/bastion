<?php


namespace app\models;


class Pages extends \yii\db\ActiveRecord{
    
    public static function tableName(): string {
        return 'pages';
    }

    public function getChildren()
    {
        return $this->hasMany(Pages::class, ['parent_id' =>'id']);
    }
   
}