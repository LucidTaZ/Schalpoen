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
        $recentPosts = Post::findRecentlyPublished()
            ->limit(10)
            ->all();
        $popularTags = Tag::getPopularTags();
        return $this->render('menu', [
            'recentPosts' => $recentPosts,
            'popularTags' => $popularTags,
            'isAuthor' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_author,
            'isPublisher' => !Yii::$app->user->isGuest && Yii::$app->user->identity->is_publisher,
        ]);
    }
}
