<?php

namespace app\widgets;

use app\models\Post;
use app\models\Tag;
use yii\base\Widget;

class Menu extends Widget
{
    /**
     * @var Post[]
     */
    public $recentPosts = [];

    /**
     * @var Tag[]
     */
    public $popularTags = [];

    public function run()
    {
        return $this->render('menu', [
            'recentPosts' => $this->recentPosts,
            'popularTags' => $this->popularTags,
        ]);
    }
}