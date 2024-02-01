<?php

namespace App\Behavioral\Command;

class Invoker
{
    private CommandInterface $command;
    
    public function setCommand(CommandInterface $command): void
    {
        $this->command = $command;
    }
    
    public function run(): void
    {
        $this->command->execute();
    }
}