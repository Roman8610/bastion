<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;
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

    public $imageFile;

    public $current_img = null;

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
            [['text', 'status', 'show_main', 'show_footer', 'show_icons_block'], 'string'],
            [['title', 'title_seo', 'title_menu'], 'string', 'max' => 255],
            [['imageFile'], 'file'],
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
            'show_icons_block' => 'Показывать на главной странице',
            'imageFile' => 'Иконка',
            'img' => 'Иконка',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

      //  var_dump($this->current_img); die;

        if ($this->imageFile instanceof UploadedFile) {
            if ($this->validate()) {
                $path = $this->uniqImageName($this->imageFile);
                if($this->imageFile->saveAs($path))
                {
                    $this->img = $path;
                }
            }

        }
        else
        {
            if(!$this->current_img)
            {
                $this->img = null;
            }
            else
            {
                $this->img = $this->current_img;
            }

        }
    
        
        return true;
    }

    public function uniqImageName($imageFile, $i=0)
    {
        $name = $i == 0 ? $this->imageFile->baseName : $this->imageFile->baseName . '-' . $i;
        $path = 'images/icons/' . $name . '.' . $this->imageFile->extension;
        if(file_exists($path))
        {
            $i++;
            $path = $this->uniqImageName($imageFile, $i);
        }

        return $path;
    }

}
