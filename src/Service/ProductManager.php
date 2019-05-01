<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * ProductManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ProductRepository $productRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $productRepository;
    }

    /**
     * @return ProductRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param array $params
     * @return Product
     */
    public function create(array $params)
    {
        $product = new Product();
        $this->save($product, $params);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $params
     */
    public function save(Product $product, array $params)
    {
        $this->parse($product, $params);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    /**
     * @param Product $product
     */
    public function delete(Product $product)
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    /**
     * @param Product $product
     * @param array $params
     */
    private function parse(Product $product, array $params)
    {
        if (isset($params['name'])) {
            $product->setName($params['name']);
        }

        if (isset($params['description'])) {
            $product->setDescription($params['description']);
        }

        if (isset($params['price'])) {
            $product->setPrice(floatval($params['price']));
        }
    }
}