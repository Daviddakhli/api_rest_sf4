<?php

namespace App\Model\Product;

/**
 * Description of Result.
 */
class Result
{
    /**
     * @var Product[]
     */
    public $products = [];

    /**
     * @var int
     */
    public $page;

    /**
     * @var int
     */
    public $limit;

    /**
     * @var int
     */
    public $total;
}
