<?php

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\Basket;
use AcmeWidgetCo\Discount;

/**
 * Class BasketTest
 * @package AcmeWidgetCo\Tests
 */
class BasketTest extends TestCase
{
    private $basket;

    protected function setUp(): void
    {
        $catalogue = [
            'R01' => ['code' => 'R01', 'price' => 32.95],
            'G01' => ['code' => 'G01', 'price' => 24.95],
            'B01' => ['code' => 'B01', 'price' => 7.95],
        ];

        $deliveryRules = [
            'under_50' => 4.95,
            'under_90' => 2.95,
            'free' => 0.00,
        ];

        $discountRules = [
            'R01' => 'buy_one_get_one_half',
        ];

        $discount = new Discount($discountRules);
        $this->basket = new Basket($catalogue, $deliveryRules, $discount);
    }

    public function testBasketTotal()
    {
        $this->basket->add('B01');
        $this->basket->add('G01');
        $this->assertEquals(37.85, $this->basket->total());

        $this->basket->add('R01');
        $this->assertEquals(68.8, $this->basket->total());

        $this->basket->add('R01');
        $this->assertEquals(85.28, $this->basket->total());
    }
}