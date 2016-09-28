<?php

namespace tests\functional;

use app\models\Post;
use app\models\Tag;
use app\models\User;
use LogicException;

class IntegrationTest
{
    public $plainUserPassword = 'functionaltester';

    protected function ensureTestPost(): Post
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

    protected function ensureTestUser(): User
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
        $user->plainPassword = $this->plainUserPassword;
        if (!$user->save()) {
            throw new LogicException('Failed to save test user');
        }
        return $user;
    }

    protected function ensureTestTag(string $title): Tag
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
