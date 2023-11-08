<?php

namespace App\Http\Controllers\Api;

use App\Collections\ItemsCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
        /**
     * @OA\get(
     *    path="/api/items",
     *    operationId="showallitems",
     *    tags={"Item"},
     *    summary="show all Items",
     *    description="show all Items Here",
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
     *               @OA\Property(property="items", type = "object")
     *            ),
     *          ),
     *       ),
     *  )
     */
    public function index(Request $request)
    {
        $items = ItemResource::collection(ItemsCollection::collection($request));
        return response()->json(['items' => $items], 200);
    }

    /**
     * @OA\get(
     * path="/api/items/{item}",
     * operationId="getitemById",
     * tags={"Item"},
     * summary="get item By Id",
     * description="get item By Id Here",
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
     *          description="get item By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="item", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */


    public function show(Item $item)
    {
        return response()->json(['item' => new ItemResource($item)], 200);
    }

        /**
     * @OA\Post(
     * path="/api/items",
     * operationId="createitems",
     * tags={"Item"},
     * summary="create items ",
     * description="create items Here",
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
     *               required={"name","price","partition_id"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="price", type="string"),
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="partition_id", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Item created Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="item", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());
        return response()->json(['item' => new ItemResource($item)], 201);
    }

      /**
     * @OA\Put(
     * path="/api/items/{item}",
     * operationId="updateitems",
     * tags={"Item"},
     * summary="update items ",
     * description="update items Here",
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
     *               @OA\Property(property="price", type="string"),
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="partition_id", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Item updated Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="item", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->all());
        return response()->json(['item' => new ItemResource($item)], 200);
    }

         /**
     * @OA\delete(
     * path="/api/items/{id}",
     * operationId="delete-item",
     * tags={"Item"},
     * summary="Delete item",
     * description="delete item here",
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
     *          description="item deleted successfully",
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

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

            /**
     * @OA\post(
     * path="/api/items/restore/{id}",
     * operationId="restoreitemById",
     * tags={"Item"},
     * summary="restore item By Id",
     * description="restore item By Id Here",
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
     *          description="restore item By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="item", type="object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function restore($id)
    {
        $item = Item::onlyTrashed()->findOrFail($id);
        $item->restore();
        return response()->json(['item' => new ItemResource($item)], 200);
    }
}
