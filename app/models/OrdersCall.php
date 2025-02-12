<?php

namespace app\models;

class OrdersCall extends \yii\db\ActiveRecord{

    public $reCaptcha;
    
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
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            [['reCaptcha'], \kekaadrenalin\recaptcha3\ReCaptchaValidator::class, 'acceptance_score' => 1]
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
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['OrderCallScenario'] = ['name', 'phone']; // укажите все поля, которые нужно валидировать
        return $scenarios;
    }
    
}