<?php

namespace App\Utils;

use App\Entity\Category;
use App\Entity\Product;
use App\Factory\ProductModelFactoryInterface;
use App\Utils\Pagination\Paginator;
use App\Model\Product\Result;
use Doctrine\ORM\EntityManagerInterface;

class CategoryProduct
{
    /** @var EntityManager $em * */
    private $em;

    /** @var PaginationInterface $paginator * */
    private $paginator;

    /** @var ProductModelFactoryInterface $productModelFactory * */
    private $productModelFactory;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, Paginator $paginator, ProductModelFactoryInterface $productModelFactory)
    {
        $this->em = $em;
        $this->paginator = $paginator;
        $this->productModelFactory = $productModelFactory;
    }

    /**
     * Gets the all categories.
     *
     * @return array
     */
    public function getAllCategory()
    {
        return $this->getCategoryRepository()->findAll();
    }

    /**
     * Create a category.
     *
     * @return array
     */
    public function postCategory($category)
    {
        $this->persistAndFlush($category);

        return $category;
    }

    /**
     * Create a product.
     *
     * @return array
     */
    public function postProduct($product)
    {
        foreach ($product->getCategories() as $category) {
            $product->removeCategory($category);
            $objCategory = $this->getCategoryRepository()->findOneBy(['name' => $category->getName()]);
            if ($objCategory) {
                $product->addCategory($objCategory);
            }
        }
        $this->persistAndFlush($product);

        return $product;
    }

    /**
     * Gets the all products by category.
     *
     * @param int $id
     * @param int $page
     * @param int $limit
     *
     * @return array|Product
     */
    public function getAllProductByCategory($id, $page = 1, $limit = 10)
    {
        $category = $this->getCategorybyId($id);
        $queryResult = $this->getProductRepository()->findByCategory($category);
        $pagination = $this->paginator->paginate($queryResult, $page, $limit);

        return
            $this->getProductListResult(
                $pagination->getItems(),
                $page,
                $limit,
                $pagination->getTotalItemCount()
            );
    }

    /**
     * Get a category by Id.
     *
     * @param int $id
     *
     * @return Category
     */
    public function getCategorybyId($idCategory)
    {
        return $this->getCategoryRepository()->findOneBy(['id' => $idCategory]);
    }

    /**
     * @param Product[] $products
     * @param int       $page
     * @param int       $limit
     * @param int       $total
     *
     * @return Result
     */
    private function getProductListResult($products, $page = null, $limit = null, $total = null)
    {
        return $this->productModelFactory->getProductListResult($products, $page, $limit, $total);
    }

    /**
     * @return \App\Repository\ProductRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getProductRepository()
    {
        return $this->em->getRepository('App:Product');
    }

    /**
     * @param $entity
     */
    private function persistAndFlush($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @return \App\Repository\CategoryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getCategoryRepository()
    {
        return $this->em->getRepository('App:Category');
    }
}
