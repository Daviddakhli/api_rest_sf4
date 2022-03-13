<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends EntityRepository
{
    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByCategory(Category $category)
    {
        return $this->createQueryBuilder('p')
           ->innerJoin('p.categories', 'c')
           ->where('c.id = :categoryId')
           ->setParameter('categoryId', $category->getId())
           ->getQuery()
           ->getResult();
    }
}
