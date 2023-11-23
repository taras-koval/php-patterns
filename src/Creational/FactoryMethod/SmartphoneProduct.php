<?php

namespace App\Creational\FactoryMethod;

class SmartphoneProduct extends AbstractProduct
{
    public function __construct($price)
    {
        $this->price = $price;
    }
}