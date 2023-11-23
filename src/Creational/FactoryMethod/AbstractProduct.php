<?php

namespace App\Creational\FactoryMethod;

abstract class AbstractProduct
{
    protected string $name;
    protected float $price;
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getPrice(): float
    {
        return $this->price;
    }
}