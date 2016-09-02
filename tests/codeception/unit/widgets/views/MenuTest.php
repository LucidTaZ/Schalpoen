<?php

namespace app\tests\codeception\unit\widgets\views;

use yii\base\ViewContextInterface;
use yii\codeception\TestCase;
use yii\web\View;

class MenuTest extends TestCase implements ViewContextInterface
{
    public function getViewPath()
    {
        return '@app/widgets/views';
    }

    private function render(string $template, array $params = []): string
    {
        $view = new View;
        return $view->render($template, $params, $this);
    }

    public function testDraftCount()
    {
        $params = $this->getStubbedParameters();

        $params['isAuthor'] = false;
        $result1 = $this->render('menu', $params);
        $this->assertNotContains('Concepten', $result1, 'Draft link is not mentioned when not logged in as author');

        $params['isAuthor'] = true;
        $params['draftCount'] = 0;
        $result2 = $this->render('menu', $params);
        $this->assertContains('Concepten', $result2, 'Draft link is mentioned when logged in as author');
        $this->assertNotContains('Concepten (0)', $result2, 'Draft count is not shown when it is zero');

        $params['isAuthor'] = true;
        $params['draftCount'] = 3;
        $result3 = $this->render('menu', $params);
        $this->assertContains('Concepten (3)', $result3, 'Draft count is shown when logged in as author');

    }

    private function getStubbedParameters()
    {
        return [
            'draftCount' => 0,
            'recentPosts' => [],
            'popularTags' => [],
            'isAuthor' => false,
            'isPublisher' => false,
        ];
    }
}
