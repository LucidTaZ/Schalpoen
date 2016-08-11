<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
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
 * @property string $route
 * @property string $slug
 * @property string $plainPassword
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
            [['username', 'displayName', 'password'], 'required'],
            [['username'], 'unique'],
            [['expose_email', 'notify_replies', 'is_author', 'is_publisher', 'created_at'], 'integer'],
            [['username', 'displayName', 'email', 'auth_key'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 60],
            [['email'], 'email'],
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
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

    public function getRoute(): string
    {
        return '/user/' . $this->id . '/' . $this->slug;
    }

    public function getSlug(): string
    {
        return Inflector::slug($this->displayName);
    }

    public function setPlainPassword(string $password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
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
