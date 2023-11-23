<?php

namespace Tests\Creational\Singleton;

use App\Creational\Singleton\Singleton;
use Exception;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{
    public function testGetInstance()
    {
        $firstCall = Singleton::getInstance();
        $secondCall = Singleton::getInstance();
        
        $this->assertInstanceOf(Singleton::class, $firstCall);
        $this->assertSame($firstCall, $secondCall);
    }
    
    public function testWakeup()
    {
        $instance = Singleton::getInstance();
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Cannot unserialize singleton');
        
        $serialized = serialize($instance);
        unserialize($serialized);
    }
}
