<?php

namespace AcmeWidgetCo;

/**
 * Class Product
 * @package AcmeWidgetCo
 * @author Ganesh Sharma
 */
class Product
{
    /**
     * @var string Product code
     */
    public $code;

    /**
     * @var string Product name
     */
    public $name;

    /**
     * @var float Product price
     */
    public $price;

    /**
     * Product constructor.
     *
     * @param string $code
     * @param string $name
     * @param float $price
     */
    public function __construct(string $code, string $name, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }
}
