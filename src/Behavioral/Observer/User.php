<?php

namespace App\Behavioral\Observer;

use SplObserver;
use SplSubject;

class User implements SplObserver
{
    private array $news = [];
    
    public function __construct(
        private string $name,
    ) {}
    
    public function update(SplSubject $subject): void
    {
        $this->news[] = $subject->getContent();
    }
    
    public function getNews(): array
    {
        return $this->news;
    }
}