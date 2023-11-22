<?php

namespace Tests\Creational\Prototype;

use App\Creational\Prototype\Author;
use App\Creational\Prototype\Post;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testObjectCanBeCloned()
    {
        $author = new Author('Taras');
        $post = new Post('My post title', 'Some post content.', $author);
        
        $postCopy = clone $post;
        
        $this->assertInstanceOf(Post::class, $postCopy);
        $this->assertSame($postCopy->getTitle(), 'MY POST TITLE COPY');
        $this->assertNotSame($post->author, $postCopy->author);
    }
}
