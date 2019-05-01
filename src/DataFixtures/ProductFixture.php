<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $index = $i + 1;

            $product = new Product();
            $product->setName("Product {$index}");
            $product->setDescription("Product description {$index}");
            $product->setPrice(rand(1, 1000));

            $manager->persist($product);
            $manager->flush();
        }
    }
}
