<?php

namespace App\Behavioral\Command;

interface UndoableCommandInterface extends CommandInterface
{
    public function undo();
}