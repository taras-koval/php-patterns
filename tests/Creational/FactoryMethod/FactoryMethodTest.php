<?php

namespace Tests\Creational\FactoryMethod;

use App\Creational\FactoryMethod\LaptopProduct;
use App\Creational\FactoryMethod\ProductFactory;
use App\Creational\FactoryMethod\SmartphoneProduct;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testObjectCanBeCloned()
    {
        $factory = new ProductFactory();
        
        $smartphone = $factory->create('smartphone', 5000);
        $laptop = $factory->create('laptop', 7000);
        
        $this->assertInstanceOf(SmartphoneProduct::class, $smartphone);
        $this->assertInstanceOf(LaptopProduct::class, $laptop);
    }
}
