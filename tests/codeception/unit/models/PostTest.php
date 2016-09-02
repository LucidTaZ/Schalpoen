<?php

namespace app\tests\codeception\unit\models;

use app\models\Post;
use yii\codeception\TestCase;

class PostTest extends TestCase
{
    public function testGetFirstParagraph()
    {
        $post = new Post;

        $post->text = '';
        $this->assertEquals('', $post->firstParagraph);

        $post->text = "\nSecond line";
        $this->assertEquals('', $post->firstParagraph);

        $post->text = 'Single line';
        $this->assertEquals('Single line', $post->firstParagraph);

        $post->text = "First line\nSecond line";
        $this->assertEquals('First line', $post->firstParagraph);

        $post->text = "First line\nSecond line\nThird line";
        $this->assertEquals('First line', $post->firstParagraph);

        $longText = str_repeat('word ', 500);
        $post->text =  $longText . "\nSecond line";
        $this->assertEquals($longText, $post->firstParagraph);
    }

    public function testSetIsPublished()
    {
        $post = new Post;
        $post->isPublished = true;

        $this->assertEquals(Post::STATUS_PUBLISHED, $post->status);
        $this->assertNotEmpty($post->published_at);
        $this->assertTrue($post->isPublished);
    }
}
