<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartitionRequest;
use App\Models\Partition;
use Illuminate\Http\Request;

class PartitionsController extends Controller
{
        /**
     * @OA\get(
     *    path="/api/partitions",
     *    operationId="showallpartitions",
     *    tags={"Partition"},
     *    summary="show all partitions",
     *    description="show all  partitions Here",
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
     *               @OA\Property(property="partitions", type = "object")
     *            ),
     *          ),
     *       ),
     *  )
     */
    public function index()
    {
        $partitions = Partition::all();
        return response()->json(['partitions' => $partitions], 200);
    }

    /**
     * @OA\get(
     * path="/api/partitions/{partition}",
     * operationId="getpartitionById",
     * tags={"Partition"},
     * summary="get partition By Id",
     * description="get partition By Id Here",
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
     *          description="get partition By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="partition", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function show(Partition $partition)
    {
        return response()->json(['partition' => $partition], 200);
    }

      /**
     * @OA\Post(
     * path="/api/partitions",
     * operationId="createpartitions",
     * tags={"Partition"},
     * summary="create partitions ",
     * description="create partitions Here",
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
     *               required={"name","category_id"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="category_id", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="partition created Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="partition", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function store(PartitionRequest $request)
    {
        $partition = Partition::create($request->all());
        return response()->json(['partition' => $partition], 201);
    }

          /**
     * @OA\Put(
     * path="/api/partitions/{partition}",
     * operationId="updatepartitions",
     * tags={"Partition"},
     * summary="update partitions ",
     * description="update partitions Here",
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
     *               @OA\Property(property="category_id", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="partition updated Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="partition", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */
    public function update(PartitionRequest $request, Partition $partition)
    {
        $partition->update($request->all());
        return response()->json(['partition' => $partition], 200);
    }

         /**
     * @OA\delete(
     * path="/api/partitions/{id}",
     * operationId="delete-partition",
     * tags={"Partition"},
     * summary="Delete partition",
     * description="delete partition here",
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
     *          description="partition deleted successfully",
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

    public function destroy(Partition $partition)
    {
        $partition->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

        /**
     * @OA\post(
     * path="/api/partitions/restore/{id}",
     * operationId="restorepartitionById",
     * tags={"Partition"},
     * summary="restore partition By Id",
     * description="restore partition By Id Here",
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
     *          description="restore partition By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="partition", type="object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function restore($id)
    {
        $partition = Partition::onlyTrashed()->findOrFail($id);
        $partition->restore();
        return response()->json(['partition' => $partition], 200);
    }
}
