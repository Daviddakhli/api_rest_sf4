<?php

namespace App\Controller;

use App\Entity\Product;
use App\Utils\CategoryProduct;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Exception\ValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class ProductController extends FOSRestController
{
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"product"})
     * @Rest\Post("/products", name="post_product")
     * @ParamConverter("product", converter="fos_rest.request_body")
     * @SWG\Post(
     *      tags={"Product"},
     *      summary="Create product",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *           name="form",
     *           in="body",
     *           @Model(type=Product::class, groups={"product"})
     *      ),
     *      @SWG\Response(
     *          response=Response::HTTP_CREATED,
     *          description="Create product",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class, groups={"product"})
     *          )
     *      )
     * )
     *
     * @param Product                          $product
     * @param CategoryProduct                  $categoryProduct
     * @param ConstraintViolationListInterface $validationErrors
     *
     * @return Product
     */
    public function postProduct(Product $product, CategoryProduct $categoryProduct, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        return $categoryProduct->postProduct($product);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/categories/{id}/products", name="get_product")
     * @REST\QueryParam(name="page", requirements="\d+", default="1", description="le numéro de la page à afficher")
     * @REST\QueryParam(name="limit", requirements="\d+", default="10", description="Nombre d'éléments à afficher")
     * @SWG\Get(
     *     tags={"Product"},
     *     summary="Gets the all products",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=Response::HTTP_OK,
     *         description="Gets the all products",
     *         @SWG\Schema(
     *             type="array",
     *             @Model(type=Product::class, groups={"product"})
     *         )
     *     )
     * )
     */
    public function getProducts(Request $request, ParamFetcher $paramFetcher, CategoryProduct $categoryProduct)
    {
        $page = $paramFetcher->get('page');
        $limit = $paramFetcher->get('limit');

        return $categoryProduct->getAllProductByCategory($request->get('id'), $page, $limit);
    }
}
