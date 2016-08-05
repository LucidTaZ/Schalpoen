<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $displayName
 * @property string $email
 * @property integer $expose_email
 * @property integer $notify_replies
 * @property string $password
 * @property string $auth_key
 * @property integer $is_author
 * @property integer $is_publisher
 * @property integer $created_at
 *
 * @property Comment[] $comments
 * @property Post[] $posts
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'displayName', 'email', 'password'], 'required'],
            [['expose_email', 'notify_replies', 'is_author', 'is_publisher', 'created_at'], 'integer'],
            [['username', 'displayName', 'email', 'auth_key'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 60],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Gebruikersnaam',
            'displayName' => 'Weergave naam',
            'email' => 'E-mail adres',
            'expose_email' => 'E-mail weergeven?',
            'notify_replies' => 'Antwoordnotificaties?',
            'password' => 'Wachtwoord',
            'auth_key' => 'Auth Key',
            'is_author' => 'Is auteur',
            'is_publisher' => 'Is redacteur',
            'created_at' => 'Geregistreerd op',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author_id' => 'id']);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }
}
