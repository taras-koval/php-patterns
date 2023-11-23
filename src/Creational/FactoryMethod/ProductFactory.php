<?php

namespace App\Creational\FactoryMethod;

use Exception;

class ProductFactory implements FactoryInterface
{
    public function create($type, $price): SmartphoneProduct|LaptopProduct
    {
        return match ($type) {
            'smartphone' => new SmartphoneProduct($price),
            'laptop' => new LaptopProduct($price),
            default => throw new Exception('Wrong product type.'),
        };
    }
}