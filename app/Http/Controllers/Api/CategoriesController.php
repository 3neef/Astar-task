<?php

namespace App\Http\Controllers\Api;

use App\Collections\CategoriesCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @OA\get(
     *    path="/api/categories",
     *    operationId="showallcatogre",
     *    tags={"Category"},
     *    summary="show all catogries",
     *    description="show all  Category Here",
     *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="perPage", type="integer"),
     *               @OA\Property(property="onlyRequested", type="boolean"),
     *            ),
     *        ),
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *               *  @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="categories", type = "object")
     *            ),
     *          ),
     *       ),
     *  )
     */
    public function index(Request $request)
    {
        $categories = CategoryResource::collection(CategoriesCollection::collection($request));
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * @OA\get(
     * path="/api/categories/{category}",
     * operationId="getcategoryById",
     * tags={"Category"},
     * summary="get category By Id",
     * description="get category By Id Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      @OA\Response(
     *        response=200,
     *          description="get category By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="category", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */


    public function show(Category $category)
    {

        if($category){
            return response()->json(['category' => new CategoryResource($category)], 200);
        }else{
            return response()->json(['item' => "not found"], 200);
        }
    }

      /**
     * @OA\Post(
     * path="/api/categories",
     * operationId="createcategories",
     * tags={"Category"},
     * summary="create categories ",
     * description="create categories Here",
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="description", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="category created Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="category", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        if($category){
            return response()->json(['category' => new CategoryResource($category)], 201);
        }else{
            return response()->json(['item' => "something went wrong"], 200);
        }
    }

    /**
     * @OA\Put(
     * path="/api/categories/{category}",
     * operationId="updatecategories",
     * tags={"Category"},
     * summary="update categories ",
     * description="update categories Here",
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="description", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="category updated Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="category", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        if($category){
            return response()->json(['category' => new CategoryResource($category)], 200);
        }else{
            return response()->json(['item' => "something went wrong"], 200);
        }
        return response()->json(['item' => "something went wrong"], 200);
    }

     /**
     * @OA\delete(
     * path="/api/categories/{id}",
     * operationId="delete-category",
     * tags={"Category"},
     * summary="Delete category",
     * description="delete category here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="category deleted successfully",
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

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

            /**
     * @OA\post(
     * path="/api/categories/restore/{id}",
     * operationId="restorecategoryById",
     * tags={"Category"},
     * summary="restore category By Id",
     * description="restore category By Id Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      @OA\Response(
     *        response=200,
     *          description="restore category By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="category", type="object")
     *            ),
     *          ),
     *       ),
     * )
     */
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return response()->json(['category' => new CategoryResource($category)], 200);
    }
}
