<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

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
 * @property string $route
 * @property string $slug
 * @property string $absolutePreviewUrl Preview image source URL
 * @property bool $isPublished
 * @property string $firstParagraph
 * @property string $parsedFirstParagraph
 * @property string $parsedText
 *
 * @property Comment[] $comments
 * @property User $author
 * @property Tag[] $tags
 */
class Post extends ActiveRecord
{
    const STATUS_DRAFT = 'draft';
    const STATUS_FINALIZED = 'finalized';
    const STATUS_REJECTED = 'rejected';
    const STATUS_PUBLISHED = 'published';

    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['author_id', 'title', 'text'], 'required'],
            [['preview'], 'default', 'value' =>  'schalpoen.png'],
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

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function addTag(Tag $tag)
    {
        $this->link('tags', $tag);
    }

    public function getRoute(): string
    {
        return '/post/' . $this->id . '/' . $this->slug;
    }

    public function getSlug(): string
    {
        return Inflector::slug($this->title);
    }

    public function getAbsolutePreviewUrl(): string
    {
        return 'http://static.schalpoen.nl/content/previews/' . $this->preview;
    }

    public function getIsPublished(): bool
    {
        return $this->status == self::STATUS_PUBLISHED;
    }

    public function getFirstParagraph(): string
    {
        $firstNewlinePosition = strpos($this->text, "\n");
        if ($firstNewlinePosition === false) {
            return $this->text;
        }
        return substr($this->text, 0, $firstNewlinePosition);
    }

    public function getParsedFirstParagraph(): string
    {
        // TODO: Implement
        return nl2br(\yii\helpers\Html::encode($this->firstParagraph));
    }

    public function getParsedText(): string
    {
        // TODO: Implement
        return nl2br(\yii\helpers\Html::encode($this->text));
    }

    public function setIsPublished(bool $value)
    {
        $this->status = self::STATUS_PUBLISHED;
        $this->published_at = $value ? time() : null;
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

    /**
     * @return ActiveQuery
     */
    public static function findRecentlyPublished()
    {
        return static::find()
            ->where(['status' => self::STATUS_PUBLISHED])
            ->orderBy(['published_at' => SORT_DESC]);
    }
}
