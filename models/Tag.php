<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property string $route
 * @property string $slug
 *
 * @property Post[] $posts
 * @property Post[] $publishedPosts
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

    public function getRoute(): string
    {
        return '/tag/' . $this->id . '/' . $this->slug;
    }

    public function getSlug(): string
    {
        return Inflector::slug($this->title);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('posttag', ['tag_id' => 'id']);
    }

    public function getPublishedPosts()
    {
        return $this->getPosts()
            ->andOnCondition(['not', ['published_at' => null]]);
    }

    /**
     * @return Tag[]
     */
    public static function getPopularTags(): array
    {
        return static::find()
            ->innerJoinWith('publishedPosts')
            ->groupBy('{{tag}}.[[id]]')
            ->orderBy(['COUNT({{post}}.[[id]])' => SORT_DESC])
            ->limit(20)
            ->all();
    }
}
