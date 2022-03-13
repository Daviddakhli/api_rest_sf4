<?php

namespace App\Model\Product;

/**
 * Description of Product.
 */
class Product
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $price;

    /**
     * @var int
     */
    public $stock;

    /**
     * @var ArrayCollection
     */
    public $categories;
}
