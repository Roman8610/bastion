<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string $title_seo
 * @property string $title_menu
 * @property int $description_seo
 * @property string $text
 * @property int $priority
 * @property string $status
 * @property string $show_main
 * @property string $show_footer
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    public function getParent()
    {
        return $this->hasOne(Page::class, ['id' =>'parent_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_seo', 'title_menu', 'description_seo', 'text', 'priority', 'status', 'show_main', 'show_footer', 'show_footer_1', 'parent_id'], 'required'],
            [['priority'], 'integer'],
            [['text', 'status', 'show_main', 'show_footer'], 'string'],
            [['title', 'title_seo', 'title_menu'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родательская категория',
            'title' => 'Заголовок',
            'title_seo' => 'Title',
            'title_menu' => 'Заголовок в меню',
            'description_seo' => 'Description',
            'text' => 'Содержание',
            'priority' => 'Приоритет',
            'status' => 'Статус',
            'show_main' => 'Показывать в шапке',
            'show_footer' => 'Показывать в футере',
            'show_footer_1' => 'Показывать в нижней части футера',
        ];
    }
}
