<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

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

    public $imageFile;

    public $current_img = null;

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
            [['title', 'short_text', 'text'], 'required'],
            [['text'], 'string'],
          //  [['date'], 'safe'],
            [['title', 'img'], 'string', 'max' => 255],
            [['short_text'], 'string', 'max' => 500],
            // ['imageFile', 'image'],
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
            'title' => 'Заголовок',
            'short_text' => 'Анонс',
            'text' => 'Новость',
            'img' => 'Изображение',
          //  'date' => 'Дата',
            'imageFile' => 'Изображение'
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
                $this->img = 'images/news/default-new.webp';
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
        $path = 'images/news/' . $name . '.' . $this->imageFile->extension;
        if(file_exists($path))
        {
            $i++;
            $path = $this->uniqImageName($imageFile, $i);
        }

        return $path;
    }
}
