<?php


namespace app\models;


class Category extends \yii\db\ActiveRecord
{
    public static function tableName(): string {
        return 'category';
    }
    
    public function getChildren()
    {
        return $this->hasMany(Category::class, ['parent_id' =>'id_import']);
    }
    
     public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' =>'id_import']);
    }
    
    
//    public function getChildServices(){
//        return $this->hasMany(Services::class, ['parent_id' => 'id']);
//    }
    
}