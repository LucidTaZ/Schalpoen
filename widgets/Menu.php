<?php

namespace app\widgets;

use app\models\Post;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\base\Widget;

class Menu extends Widget
{
    public function run()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        $isGuest = Yii::$app->user->isGuest;

        if (!$isGuest) {
            $draftCount = $user->getEditablePosts()->count();
        } else {
            $draftCount = 0;
        }

        $recentPosts = Post::findRecentlyPublished()
            ->limit(10)
            ->all();
        $popularTags = Tag::getPopularTags();
        return $this->render('menu', [
            'draftCount' => $draftCount,
            'recentPosts' => $recentPosts,
            'popularTags' => $popularTags,
            'isAuthor' => !$isGuest && $user->is_author,
            'isPublisher' => !$isGuest && $user->is_publisher,
        ]);
    }
}
