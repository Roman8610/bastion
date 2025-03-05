<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class ImportStatistics extends ActiveRecord
{

    public static function tableName()
    {
        return 'import_statistics';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return[
            [['add_cat', 'skipped_cat', 'add_prod', 'skipped_prod'], 'required'],
            [['add_cat', 'skipped_cat', 'add_prod', 'skipped_prod'], 'integer'],
        ];
    }

}