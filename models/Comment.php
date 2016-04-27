<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $author_id
 * @property integer $parent_id
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post $post
 * @property User $author
 * @property Comment $parent
 * @property Comment[] $comments
 */
class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return 'comment';
    }

    public function rules()
    {
        return [
            [['post_id', 'author_id', 'created_at'], 'required'],
            [['post_id', 'author_id', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post',
            'author_id' => 'Auteur',
            'parent_id' => 'In reactie op',
            'text' => 'Tekst',
            'created_at' => 'Geschreven op',
            'updated_at' => 'Bewerkt op',
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }
}
