<?php


namespace app\models;


class News extends \yii\db\ActiveRecord{
    
    public static function tableName(): string {
        return 'news';
    }
    
}