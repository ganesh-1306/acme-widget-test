<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\Discount;

/**
 * Class Basket
 * @package AcmeWidgetCo
 * @author Ganesh Sharma
 */
class Basket
{
    private $catalogue;
    private $deliveryRules;
    private $discount;
    private $items = [];

    /**
     * Basket constructor.
     *
     * @param array $catalogue
     * @param array $deliveryRules
     * @param Discount $discount
     */
    public function __construct(array $catalogue, array $deliveryRules, Discount $discount)
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->discount = $discount;
    }

    /**
     * Add a product to the basket by its code.
     *
     * @param string $productCode
     * @return void
     */
    public function add(string $productCode): void
    {
        if (isset($this->catalogue[$productCode])) {
            $this->items[] = $this->catalogue[$productCode];
        }
    }

    /**
     * Calculate the total cost of the basket.
     *
     * @return float
     */
    public function total(): float
    {
        $itemCounts = array_count_values(array_column($this->items, 'code'));

        $subtotal = $this->discount->apply($itemCounts, $this->catalogue);

        $delivery = 0;
        if ($subtotal < 50) {
            $delivery = $this->deliveryRules['under_50'];
        } elseif ($subtotal < 90) {
            $delivery = $this->deliveryRules['under_90'];
        }

        return round($subtotal + $delivery, 2);
    }
}