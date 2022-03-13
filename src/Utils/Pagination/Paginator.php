<?php

namespace App\Utils\Pagination;

use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

/**
 * Description of Paginator.
 */
class Paginator extends PaginatorAware implements PaginatorInterface
{
    /**
     * @param mixed $query
     * @param int   $page
     * @param int   $limit
     *
     * @return PaginationInterface
     */
    public function paginate($query, $page, $limit)
    {
        $paginator = $this->getPaginator();

        return $paginator->paginate($query, $page, $limit, ['distinct' => false]);
    }
}
