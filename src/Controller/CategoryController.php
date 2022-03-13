<?php

namespace App\Controller;

use App\Entity\Category;
use App\Utils\CategoryProduct;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Exception\ValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * Class CategoryController.
 *
 * @REST\Version("v1")
 */
class CategoryController extends FOSRestController
{
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"category"})
     * @Rest\Post("/categories", name="post_category")
     * @ParamConverter("category", converter="fos_rest.request_body")
     * @SWG\Post(
     *      tags={"Category"},
     *      summary="Create category",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *           name="form",
     *           in="body",
     *           @Model(type=Category::class, groups={"category"})
     *      ),
     *      @SWG\Response(
     *          response=Response::HTTP_CREATED,
     *          description="Create category",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Category::class, groups={"category"})
     *          )
     *      )
     * )
     *
     * @param Category $category
     *
     * @return Category
     */
    public function postCategory(Category $category, CategoryProduct $categoryProduct, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        return $categoryProduct->postCategory($category);
    }

    /**
     * @Rest\View(serializerGroups={"category"})
     * @Rest\Get("/categories", name="get_categories")
     * @SWG\Get(
     *     tags={"Category"},
     *     summary="Gets the all categories",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=Response::HTTP_OK,
     *         description="Gets the all categories",
     *         @SWG\Schema(
     *             type="array",
     *             @Model(type=Category::class, groups={"category"})
     *         )
     *     )
     * )
     */
    public function getCategories(CategoryProduct $categoryProduct)
    {
        return $categoryProduct->getAllCategory();
    }
}
