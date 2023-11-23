<?php

namespace App\Creational\FactoryMethod;

class LaptopProduct extends AbstractProduct
{
    public function __construct($price)
    {
        $this->price = $price;
    }
}