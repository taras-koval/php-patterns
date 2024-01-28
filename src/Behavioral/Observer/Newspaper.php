<?php

namespace App\Behavioral\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Newspaper implements SplSubject
{
    private string $name;
    private string $content;
    private SplObjectStorage $observers;
    
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->observers = new SplObjectStorage();
    }
    
    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }
    
    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }
    
    public function notify(): void
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }
    
    public function setContent(string $content): void
    {
        $this->content = $content;
        $this->notify();
    }
    
    public function getContent(): string
    {
        return $this->content . " ({$this->name})";
    }
}