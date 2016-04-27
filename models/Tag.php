<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Post[] $posts
 */
class Tag extends ActiveRecord
{
    public static function tableName()
    {
        return 'tag';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Titel',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('posttag', ['tag_id' => 'id']);
    }
}
