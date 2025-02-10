<?php

namespace app\models;

class Orders extends \yii\db\ActiveRecord{
    
    public $file;

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
            [['name', 'phone', 'email'], 'required'],
            [['name', 'last_name', 'phone', 'email'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'safe'],
            [['prod_id'], 'number', 'min' => 0],
            [['file'], 'file'],
            [['reCaptcha'], \kekaadrenalin\recaptcha3\ReCaptchaValidator::class, 'acceptance_score' => 0.7]
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'message' => 'Комментарий к заказу',
            'file' => '',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['OrderScenario'] = ['name', 'phone', 'email', 'message', 'file']; // укажите все поля, которые нужно валидировать
        return $scenarios;
    }
    
}