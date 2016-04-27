<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "smiley".
 *
 * @property integer $id
 * @property string $file_path
 * @property string $code
 */
class Smiley extends ActiveRecord
{
    public static function tableName()
    {
        return 'smiley';
    }

    public function rules()
    {
        return [
            [['file_path', 'code'], 'required'],
            [['file_path'], 'string', 'max' => 32],
            [['code'], 'string', 'max' => 16],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_path' => 'URI pad',
            'code' => 'Code',
        ];
    }
}
