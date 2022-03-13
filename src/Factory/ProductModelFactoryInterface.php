<?php

namespace App\Factory;

use App\Model\Product\Result;

/**
 * Description of ProductModelFactoryInterface.
 */
interface ProductModelFactoryInterface
{
    /**
     * @param array    $products
     * @param null|int $page
     * @param null|int $limit
     * @param null|int $total
     *
     * @return Result
     */
    public function getProductListResult(array $products, $page = null, $limit = null, $total = null);
}
