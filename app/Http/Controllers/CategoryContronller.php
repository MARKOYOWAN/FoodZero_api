<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repository\CategoryRepositoryInterface;
use Validator;

class CategoryContronller extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth:api', ['except' => ['insertCategory']]);
        $this->categoryRepository = $categoryRepository;
    }



    /**
     * @OA\Post(
     * path="/category/insertCategory",
     * operationId="Category",
     * tags={"INSERTION CATEGORY"},
     * summary="Insert category",
     * description="Category",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"id_user", "title"}, 
     *               @OA\Property(property="id_user", type="integer"),
     *               @OA\Property(property="id_parent", type="integer"),
     *               @OA\Property(property="title", type="text"),
     *               @OA\Property(property="description", type="text"),
     *               @OA\Property(property="price", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function insertCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer',
            'id_parent' => 'integer|nullable',
            'title' => 'required|string',
            'description' => 'string|nullable',
            'price' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = Category::create(array_merge($validator->validated()));


        return response()->json([
            'success' => 'Catégory a été bien enregistrer',
            'category' => $category,
        ], 200);
    }
}