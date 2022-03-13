<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = array();

        // adding categories fixtures
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();

            $category->setName("Test Category {$i}");
            $manager->persist($category);

            $categories[] = $category;
        }

        //adding products fixtures
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product
                ->setName("Test Product {$i}")
                ->setPrice(rand(1, 1000))
                ->setStock(rand(1, 100))
                ->addCategory($categories[$i]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
