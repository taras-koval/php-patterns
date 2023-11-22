<?php

namespace Tests\Creational\Prototype;

use App\Creational\Prototype\Author;
use App\Creational\Prototype\Post;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testTest()
    {
        $post = new Post('My post title', 'Some post content.', new Author('Taras'));
        $draftPost = clone $post;
        
        $this->assertInstanceOf(Post::class, $draftPost);
        $this->assertSame($draftPost->getTitle(), 'MY POST TITLE COPY');
    }
}
