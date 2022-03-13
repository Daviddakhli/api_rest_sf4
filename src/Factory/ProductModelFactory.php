<?php

namespace App\Factory;

use App\Entity\Product;
use App\Model\Product\Result as ProductResult;
use App\Model\Product\Product as ProductModel;

/**
 * Description of ProductModelFactory.
 */
class ProductModelFactory implements ProductModelFactoryInterface
{
    public function getProductListResult(array $products, $page = null, $limit = null, $total = null)
    {
        $result = new ProductResult();
        $result->page = $page;
        $result->limit = $limit;
        $result->products = [];
        $result->total = $total;

        foreach ($products as $product) {
            $result->products[] = $this->createProduct($product);
        }

        return $result;
    }

    /**
     * @param Product $product
     *
     * @return ProductModel
     */
    private function createProduct(Product $product)
    {
        $model = new ProductModel();
        $model->id = $product->getId();
        $model->name = $product->getName();
        $model->price = $product->getPrice();
        $model->stock = $product->getStock();
        $model->categories = $product->getCategories();

        return $model;
    }
}
