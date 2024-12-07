<?php


namespace app\models;


class Product extends \yii\db\ActiveRecord{
    
    public static function tableName(): string {
        return 'product';
    }

    public function getDocs()
    {
        return $this->hasMany(DocsProd::class, ['prod_id' => 'id']);
    }
    
}