<?php

namespace app\models;

class Orders extends \yii\db\ActiveRecord{
    
    public $file;

    public static function tableName(): string {
        return 'orders';
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required'],
            [['name', 'last_name', 'phone', 'email'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'safe'],
            [['file'], 'file'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Телефон',
            'message' => 'Комментарий к заказу',
            'file' => '',
        ];
    }
    
}