<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $short_text
 * @property string $text
 * @property string|null $img
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_text', 'text', 'date'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['title', 'img'], 'string', 'max' => 255],
            [['short_text'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'short_text' => 'Анонс',
            'text' => 'Новость',
            'img' => 'Изображение',
            'date' => 'Дата',
        ];
    }
}
