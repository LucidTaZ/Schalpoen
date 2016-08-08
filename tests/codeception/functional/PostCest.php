<?php

namespace app\tests\codeception\functional;

use app\models\Post;
use app\models\Tag;
use app\models\User;
use FunctionalTester;
use LogicException;
use yii\helpers\Url;

class PostCest
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

    private function ensureTestPost(): Post
    {
        $author = $this->ensureTestUser();
        $tags = [
            $this->ensureTestTag('Testing'),
            $this->ensureTestTag('Functional Testing'),
        ];

        $post = new Post;
        $post->author_id = $author->id;
        $post->title = 'Functional test ' . time();
        $post->text = 'Functional test body';
        $post->isPublished = true;
        if (!$post->save()) {
            throw new LogicException('Failed to save test post');
        }

        foreach ($tags as $tag) {
            $post->addTag($tag);
        }

        return $post;
    }

    private function ensureTestUser(): User
    {
        $username = 'Functional tester';
        $user = User::findOne(['username' => $username]);
        if ($user !== null) {
            return $user;
        }

        $user = new User;
        $user->username = $username;
        $user->displayName = $username;
        $user->email = 'functionaltester@schalpoen.nl';
        $user->password = 'functionaltester';
        if (!$user->save()) {
            throw new LogicException('Failed to save test user');
        }
        return $user;
    }

    private function ensureTestTag(string $title): Tag
    {
        $tag = Tag::findOne(['title' => $title]);
        if ($tag !== null) {
            return $tag;
        }

        $tag = new Tag;
        $tag->title = $title;
        if (!$tag->save()) {
            throw new LogicException('Failed to save test tag');
        }
        return $tag;
    }
}
