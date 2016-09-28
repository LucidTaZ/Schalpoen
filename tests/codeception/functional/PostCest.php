<?php

namespace tests\functional;

use FunctionalTester;
use yii\helpers\Url;

class PostCest extends IntegrationTest
{
    public function slugWorks(FunctionalTester $I)
    {
        $I->am('a reader');
        $I->wantTo('see slugs');
        $I->lookForwardTo('know what the article is about when I see the link');
        $I->comment('numeric slugs is one of the things to be tested as a regression test');

        $post = $this->ensureTestPost();
        $post->title = 'numeric 1337 title';

        try {
            $I->amOnPage(Url::toRoute(['/post/' . $post->id . '/' . $post->slug]));
            $I->seeResponseCodeIs(200);
        } finally {
            $post->delete();
        }
    }

    public function slugIsArbitrary(FunctionalTester $I)
    {
        $I->am('a web archive');
        $I->wantTo('keep using stored URLs');
        $I->lookForwardTo('reach the intended articles');
        $I->comment('if the new slugger differs from the old one, it should not make articles unreachable');

        $post = $this->ensureTestPost();

        try {
            $I->amOnPage(Url::toRoute(['/post/' . $post->id . '/whatever']));
            $I->seeResponseCodeIs(200);
        } finally {
            $post->delete();
        }
    }
}
