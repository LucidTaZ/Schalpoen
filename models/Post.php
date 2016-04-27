<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property string $preview
 * @property string $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Comment[] $comments
 * @property User $author
 * @property Tag[] $tags
 */
class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['author_id', 'created_at'], 'required'],
            [['author_id', 'published_at', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['preview'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 16],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Auteur',
            'title' => 'Titel',
            'text' => 'Tekst',
            'preview' => 'Voorbeeld',
            'status' => 'Status',
            'published_at' => 'Gepubliceerd op',
            'created_at' => 'Geschreven op',
            'updated_at' => 'Bewerkt op',
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('posttag', ['post_id' => 'id']);
    }
}