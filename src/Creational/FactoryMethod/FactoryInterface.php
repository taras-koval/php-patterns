<?php

namespace App\Creational\FactoryMethod;

interface FactoryInterface
{
    public function create($type, $price);
}