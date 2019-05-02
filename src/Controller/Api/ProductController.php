<?php

namespace App\Controller\Api;

use App\Service\ProductManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Product;


/**
 * @Rest\Route("/products")
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @param ProductManager $productManager
     */
    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
    }

    /**
     * @Rest\Get("/")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns product list",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class))
     *     )
     * )
     *
     * @return View
     */
    public function getProductsAction() : View
    {
        return View::create($this->productManager->getRepository()->findAll(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/{id}", requirements={"id": "\d+"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns a single product by given id",
     *     @Model(type=Product::class)
     * )
     *
     * @param int $id
     * @return View
     */
    public function getProductAction(int $id) : View
    {
        $product = $this->productManager->getRepository()->find($id);

        if (empty($product)) {
            throw $this->createNotFoundException();
        }

        return View::create($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/")
     *
     * @Rest\RequestParam(name="name", requirements=".+", description="Name", allowBlank=false)
     * @Rest\RequestParam(name="description", requirements=".+", description="Description", allowBlank=false)
     * @Rest\RequestParam(name="price", requirements="^-?(?:\d+|\d*\.\d+)$", description="Price", allowBlank=false)
     *
     * @SWG\Response(
     *     response=201,
     *     description="Creates a new product with given information",
     *     @Model(type=Product::class)
     * )
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function postProductAction(ParamFetcher $paramFetcher): View
    {
        $product = $this->productManager->create($paramFetcher->all());

        return View::create($product, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/{id}", requirements={"id": "\d+"})
     *
     * @Rest\RequestParam(name="name", requirements=".+", description="Name", nullable=true)
     * @Rest\RequestParam(name="description", requirements=".+", description="Description", nullable=true)
     * @Rest\RequestParam(name="price", requirements="^-?(?:\d+|\d*\.\d+)$", description="Price", nullable=true)
     *
     * @SWG\Response(
     *     response=201,
     *     description="Updates product information",
     *     @Model(type=Product::class)
     * )
     *
     * @param int $id
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function putProductAction(int $id, ParamFetcher $paramFetcher) : View
    {
        $product = $this->productManager->getRepository()->find($id);

        if (empty($product)) {
            throw $this->createNotFoundException();
        }

        $this->productManager->save($product, $paramFetcher->all());

        return View::create($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/{id}", requirements={"id": "\d+"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Deletes a single product by given id",
     * )
     *
     * @param int $id
     * @return View
     */
    public function deleteProductAction(int $id): View
    {
        $product = $this->productManager->getRepository()->find($id);

        if (empty($product)) {
            throw $this->createNotFoundException();
        }

        $this->productManager->delete($product);

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}