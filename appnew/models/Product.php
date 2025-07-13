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

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_import' => 'category_id']);
    }
    
}