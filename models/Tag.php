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

    /**
     * @return Tag[]
     */
    public static function getPopularTags(): array
    {
        // TODO: Implement
        return [
            new static([
                'id' => 2,
                'title' => 'Debug1',
            ]),
            new static([
                'id' => 3,
                'title' => 'Debug2',
            ]),
        ];
    }
}
