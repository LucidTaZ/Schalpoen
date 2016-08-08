<?php

namespace app\tests\codeception\unit\views\post;

use app\models\Post;
use app\models\User;
use yii\base\ViewContextInterface;
use yii\codeception\TestCase;
use yii\web\View;

class ShortPostTest extends TestCase implements ViewContextInterface
{
    public function getViewPath()
    {
        return '@app/views/post';
    }

    private function render(string $template, array $params = []): string
    {
        $view = new View;
        return $view->render($template, $params, $this);
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
