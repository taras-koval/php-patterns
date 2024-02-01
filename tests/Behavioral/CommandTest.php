<?php

namespace Behavioral;

use App\Behavioral\Command\MessageWithDateCommand;
use App\Behavioral\Command\HelloWorldCommand;
use App\Behavioral\Command\Invoker;
use App\Behavioral\Command\Receiver;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testInvocation()
    {
        $invoker = new Invoker();
        $receiver = new Receiver();
        
        $invoker->setCommand(new HelloWorldCommand($receiver));
        $invoker->run();
        
        $this->assertSame('Hello World', $receiver->getOutput());
    }
    
    public function testUndoableCommand()
    {
        $receiver = new Receiver();
        $invoker = new Invoker();
        
        $helloWorldCommand = new HelloWorldCommand($receiver);
        $messageWithDateCommand = new MessageWithDateCommand($receiver);
        
        $invoker->setCommand($helloWorldCommand);
        $invoker->run();
        $this->assertSame('Hello World', $receiver->getOutput());
        
        
        $messageWithDateCommand->execute();
        
        $invoker->run();
        $this->assertSame(
            "Hello World\nHello World " . date('Y-m-d'),
            $receiver->getOutput()
        );
        
        $messageWithDateCommand->undo();
        
        $invoker->run();
        $this->assertSame(
            "Hello World\nHello World " . date('Y-m-d') . "\nHello World",
            $receiver->getOutput()
        );
    }
}