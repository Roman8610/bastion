<?php


namespace app\models;


class AttrProd extends \yii\db\ActiveRecord{
    
    public static function tableName(): string {
        return 'attr_prod';
    }
    
    public function saveAttrProd($attr_id, $prod_id)
    {

    }

    public function getValue()
    {
        return $this->hasOne(AttrValue::class, ['id' => 'attr_id']);
    }


}