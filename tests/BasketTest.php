<?php

namespace Acme\Tests;

use Acme\Basket;
use Acme\Offers\BuyOneGetOneHalfOffOffer;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    //Widgets
    private array $catalogue = [
        'R01' => 32.95,
        'G01' => 24.95,
        'B01' => 7.95,
    ];

    // - Free delivery for orders over $90
        // - $2.95 delivery for orders over $50
    // - $4.95 delivery for orders below $50
    private array $deliveryRules = [
        ['threshold' => 90, 'cost' => 0],
        ['threshold' => 50, 'cost' => 2.95],
        ['threshold' => 0, 'cost' => 4.95],
    ];

    private function getBasket(): Basket
    {
        $offer = new BuyOneGetOneHalfOffOffer('R01');
        return new Basket($this->catalogue, $this->deliveryRules, [$offer]);
    }

    public function testBasketWithB01AndG01(): void
    {
        $basket = $this->getBasket();
        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }

    // Test for adding two Red Widgets (R01) and checking the discount on the second
    public function testBasketWithTwoR01(): void
    {
        $basket = $this->getBasket();
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.37, $basket->total());
    }

    // Test for adding one Red Widget (R01) and one Green Widget (G01)
    public function testBasketWithR01AndG01(): void
    {
        $basket = $this->getBasket();
        $basket->add('R01');
        $basket->add('G01');

        $this->assertEquals(60.85, $basket->total());
    }

    // Test for multiple products, including 3 Red Widgets (R01)
    public function testBasketWithMultipleItems(): void
    {
        $basket = $this->getBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(98.27, $basket->total());
    }
}
