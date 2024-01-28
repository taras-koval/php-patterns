<?php

namespace Tests\Behavioral;

use App\Behavioral\Observer\Newspaper;
use App\Behavioral\Observer\User;
use PHPUnit\Framework\TestCase;

class ObserverTest extends TestCase
{
    public function testNotifyObservers(): void
    {
        $newspaper = new Newspaper('Daily News');
        $observer = new User('John Doe');
        
        $newspaper->attach($observer);
        $newspaper->setContent('Breaking News');
        
        $this->assertEquals(['Breaking News (Daily News)'], $observer->getNews());
    }
    
    public function testGetNews()
    {
        $newspaper = new Newspaper('NewYork Times');
        
        $user1 = new User('Foo');
        $user2 = new User('Bar');
        
        $newspaper->attach($user1);
        $newspaper->attach($user2);
        
        $newspaper->setContent('Breaking News 1');
        $newspaper->setContent('Breaking News 2');
        
        $newspaper->detach($user2);
        
        $newspaper->setContent('Breaking News 3');
        
        $this->assertCount(3, $user1->getNews());
        $this->assertCount(2, $user2->getNews());
    }
}
