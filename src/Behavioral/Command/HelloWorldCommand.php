<?php

namespace App\Behavioral\Command;

class HelloWorldCommand implements CommandInterface
{
    public function __construct(private Receiver $output)
    {
    }
    
    public function execute(): void
    {
        $this->output->write('Hello World');
    }
}