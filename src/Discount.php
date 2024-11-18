<?php

namespace AcmeWidgetCo;

/**
 * Class Discount
 * @package AcmeWidgetCo
 * @author Ganesh Sharma
 */
class Discount
{
    private $rules;

    /**
     * Discount constructor.
     *
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Apply discounts to the basket subtotal based on rules.
     *
     * @param array $itemCounts
     * @param array $catalogue
     * @return float Adjusted subtotal after discounts
     */
    public function apply(array $itemCounts, array $catalogue): float
    {
        $subtotal = 0;

        foreach ($itemCounts as $code => $count) {
            if (isset($this->rules[$code])) {
                $subtotal += $this->applyRule($code, $count, $catalogue[$code]['price']);
            } else {
                $subtotal += $catalogue[$code]['price'] * $count;
            }
        }

        return $subtotal;
    }

    /**
     * Apply a specific rule to an item.
     *
     * @param string $code
     * @param int $count
     * @param float $price
     * @return float Adjusted price after rule is applied
     */
    private function applyRule(string $code, int $count, float $price): float
    {
        $subtotal = 0;

        if ($this->rules[$code] === 'buy_one_get_one_half') {
            $fullPriceItems = intdiv($count, 2);
            $halfPriceItems = $count - $fullPriceItems * 2;

            $subtotal += $fullPriceItems * ($price + $price / 2);
            $subtotal += $halfPriceItems * $price;
        }

        return $subtotal;
    }
}