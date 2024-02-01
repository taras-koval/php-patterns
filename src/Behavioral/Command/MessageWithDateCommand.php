<?php

namespace App\Behavioral\Command;

class MessageWithDateCommand implements UndoableCommandInterface
{
    public function __construct(private Receiver $output)
    {
    }
    
    public function execute(): void
    {
        $this->output->enableDate();
    }
    
    public function undo(): void
    {
        $this->output->disableDate();
    }
}