<?php
namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName(): string {
        return 'category';
    }
    
    public function attributes()
    {
        return array_merge(parent::attributes(), ['text']);
    }
    
    public function rules()
    {
        return [
            ['text', 'string'],
            ['text', 'default', 'value' => null],
        ];
    }
    
    public function getChildren()
    {
        return $this->hasMany(Category::class, ['parent_id' =>'id_import']);
    }
    
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' =>'id_import']);
    }
    
    public static function getAllDescendantIds($parentId)
    {
        $directChildren = self::find()->select('id_import')->where(['parent_id' => $parentId])->column();

        $result = [];
        
        foreach ($directChildren as $childId) {
            $result[] = $childId;

            $descendantIds = self::getAllDescendantIds($childId);
            $result = array_merge($result, $descendantIds);
        }

        return $result;
    }
}