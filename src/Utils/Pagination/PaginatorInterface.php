<?php

namespace App\Utils\Pagination;

use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Description of PaginatorInterface.
 */
interface PaginatorInterface
{
    /**
     * @param mixed $query
     * @param int   $page
     * @param int   $limit
     *
     * @return PaginationInterface
     */
    public function paginate($query, $page, $limit);
}
