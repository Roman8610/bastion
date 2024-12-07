<?php


namespace app\models;


class AttrValue extends \yii\db\ActiveRecord{
    
    public static function tableName(): string {
        return 'attr_value';
    }

    public function getGroup()
    {
        return $this->hasOne(AttrGroup::class, ['id' => 'attr_group_id']);
    }
    
}