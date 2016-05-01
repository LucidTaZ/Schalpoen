<?php

namespace app\widgets;

use app\models\Post;
use app\models\Tag;
use Yii;
use yii\base\Widget;

class Menu extends Widget
{
    public function run()
    {
        $recentPosts = [
            new Post([
                'id' => '4',
                'author_id' => '1',
                'title' => 'Debug title',
                'text' => 'Debug text',
            ]),
        ];
        $popularTags = [
            new Tag([
                'id' => 2,
                'title' => 'Debug1',
            ]),
            new Tag([
                'id' => 3,
                'title' => 'Debug2',
            ]),
        ];
        return $this->render('menu', [
            'recentPosts' => $recentPosts,
            'popularTags' => $popularTags,
            'isAuthor' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_author,
            'isPublisher' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_publisher,
        ]);
    }
}
