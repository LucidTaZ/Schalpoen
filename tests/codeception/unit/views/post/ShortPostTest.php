<?php

namespace tests\unit\views\post;

use app\models\Post;
use app\models\User;
use tests\unit\TestCase;
use yii\base\ViewContextInterface;

class ShortPostTest extends TestCase implements ViewContextInterface
{
    public function getViewPath()
    {
        return '@app/views/post';
    }

    public function testFirstParagraph()
    {
        $post = new Post;
        $post->text = "First line\nSecond line";

        $author = new User;
        $author->displayName = 'Functional Tester';
        $post->populateRelation('author', $author);

        $result = $this->render('_short-post', [
            'model' => $post,
        ]);

        $this->assertContains('First line', $result);
        $this->assertNotContains('nSecond line', $result);
    }
}
