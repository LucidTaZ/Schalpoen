<?php

namespace tests\unit\views\author;

use app\models\Post;
use Codeception\Specify;
use tests\unit\TestCase;
use yii\base\ViewContextInterface;
use yii\data\ArrayDataProvider;
use yii\web\View;

class DraftsTest extends TestCase implements ViewContextInterface
{
    use Specify;

    public function getViewPath()
    {
        return '@app/views/author';
    }

    private function render(string $template, array $params = []): string
    {
        $view = new View;
        return $view->render($template, $params, $this);
    }

    public function testNotificationOnNoPosts()
    {
        $finalized = new ArrayDataProvider();
        $editables = new ArrayDataProvider();

        $result = $this->render('drafts', [
            'finalized' => $finalized,
            'editables' => $editables,
        ]);

        $this->assertContains('mededeling', $result, 'CSS class "mededeling" must be present in response');
        $this->assertContains('Al je artikelen zijn gepubliceerd of afgerond en kunnen daarom niet gewijzigd worden.', $result);
    }

    public function testHeaders()
    {
        $expectedFinalizedHeader = '<h3>Afgerond</h3>';
        $expectedEditablesHeader = '<h3>In progress</h3>';

        $this->specify('Only the header of the non-empty category must be shown', function () use ($expectedFinalizedHeader, $expectedEditablesHeader) {
            $result = $this->render('drafts', [
                'finalized' => new ArrayDataProvider(['allModels' => [$this->getDummyPost()]]),
                'editables' => new ArrayDataProvider(),
            ]);

            $this->assertContains($expectedFinalizedHeader, $result, 'The appropriate header must be shown');
            $this->assertNotContains($expectedEditablesHeader, $result, 'The header for the empty category must not be shown');
        });
        $this->specify('Only the header of the non-empty category must be shown', function () use ($expectedFinalizedHeader, $expectedEditablesHeader) {
            $result = $this->render('drafts', [
                'finalized' => new ArrayDataProvider(),
                'editables' => new ArrayDataProvider(['allModels' => [$this->getDummyPost()]]),
            ]);

            $this->assertNotContains($expectedFinalizedHeader, $result, 'The header for the empty category must not be shown');
            $this->assertContains($expectedEditablesHeader, $result, 'The appropriate header must be shown');
        });
        $this->specify('Both headers can be shown', function () use ($expectedFinalizedHeader, $expectedEditablesHeader) {
            $result = $this->render('drafts', [
                'finalized' => new ArrayDataProvider(['allModels' => [$this->getDummyPost()]]),
                'editables' => new ArrayDataProvider(['allModels' => [$this->getDummyPost()]]),
            ]);

            $this->assertContains($expectedFinalizedHeader, $result, 'The appropriate header must be shown');
            $this->assertContains($expectedEditablesHeader, $result, 'The appropriate header must be shown');
        });
    }

    private function getDummyPost(): Post
    {
        return new Post;
    }
}
