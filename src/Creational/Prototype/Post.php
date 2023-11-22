<?php

namespace App\Creational\Prototype;

class Post implements PrototypeInterface
{
    private ?int $id;
    
    public function __construct(
        private string $title,
        private string $content,
        public Author $author,
    ) {}
    
    public function __clone()
    {
        $this->id = null;
        $this->title = $this->title . ' COPY';
        $this->author = clone $this->author;
    }
    
    public function getTitle(): string
    {
        return strtoupper($this->title);
    }
    
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function getContent(): string
    {
        return $this->content;
    }
    
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}