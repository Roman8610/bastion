<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string|null $last_name
 * @property string $phone
 * @property string|null $email
 * @property string|null $message
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'created_at', 'updated_at'], 'required'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'last_name', 'phone', 'email'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Email',
            'message' => 'Сообщение',
            'status' => 'Статус',
            'created_at' => 'Создана',
            'updated_at' => 'Обновлена',
            'file_path' => 'Файл',
        ];
    }
}
