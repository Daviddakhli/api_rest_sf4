<?php

namespace App\Model\Category;

/**
 * Description of Result.
 */
class Result
{
    /**
     * @var Category[]
     */
    public $category = [];

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
