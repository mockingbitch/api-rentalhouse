<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use App\Services\TagService;
use Exception;

class TagController extends Controller
{
    /**
     * Constructor
     * @param TagService $tagService
     */
    public function __construct(
        protected TagService $tagService,
    ) {
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @OA\Get(
     *     path="/tag",
     *     operationId="List Tags",
     *     tags={"Tags"},
     *     summary="List Tags",
     *     description="Get list of all tags",
     *     @OA\Parameter(
     *           name="name_vi",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="tags.name_vi like %.name_vi.%"
     *       ),
     *      @OA\Parameter(
     *            name="name_en",
     *            in="header",
     *            required=false,
     *            @OA\Schema(type="string"),
     *            description="tags.name_en like %.name_en.%"
     *        ),
     *     @OA\Parameter(
     *         name="created_at_after",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="tags.created_at >= created_at_after"
     *     ),
     *     @OA\Parameter(
     *         name="created_at_before",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="tags.created_at <= created_at_before"
     *     ),
     *     @OA\Parameter(
     *         name="id_after",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="tags.id > id_after"
     *     ),
     *     @OA\Parameter(
     *         name="page_size",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="integer", default="100"),
     *         description="Total record per page"
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="integer", default="1"),
     *         description="Current page"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *                     @OA\Property(property="name_en", type="string", example="Cheap price"),
     *                     @OA\Property(property="status", type="string", example="display"),
     *                     @OA\Property(property="created_at", type="string", example="2024-01-27 03:59:45"),
     *                     @OA\Property(property="updated_at", type="string", example="2024-01-27 03:59:45"),
     *                 ),
     *             ),
     *             @OA\Property(property="pagination",
     *                 @OA\Property(property="total", type="integer", example=1),
     *                 @OA\Property(property="page", type="integer", example=1),
     *                 @OA\Property(property="total_pages", type="integer", example=1),
     *                 @OA\Property(property="page_size", type="integer", example=100)
     *             ),
     *             @OA\Property(property="filter",
     *                 @OA\Property(property="created_at_after", type="string", nullable=true),
     *                 @OA\Property(property="created_at_before", type="string", nullable=true),
     *                 @OA\Property(property="id_after", type="string", nullable=true)
     *             )
     *         )
     *     ),
     * ),
     */
    public function index(Request $request): JsonResponse
    {
        return $this->success(
            $this->tagService->list($request->all())
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param TagRequest $request
     * @return JsonResponse
     * @throws Exception
     * @OA\Post(
     *     path="/tag",
     *     operationId="Create Tag",
     *     tags={"Tags"},
     *     summary="Create Tag",
     *     security={{"bearer": {}}},
     *     description="Create new tag",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Body data",
     *        @OA\JsonContent(
     *             @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *             @OA\Property(property="name_en", type="string", example="Cheap price"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *                     @OA\Property(property="name_en", type="string", example="Cheap price"),
     *                     @OA\Property(property="created_at", type="string", example="2024-01-27 03:59:45"),
     *                     @OA\Property(property="updated_at", type="string", example="2024-01-27 03:59:45"),
     *                 ),
     *             ),
     *             @OA\Property(property="message", type="string", example="Created successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="BAD REQUEST"),
     *                  @OA\Property(property="message", type="string", example="Bad request"),
     *                  @OA\Property(property="status", type="string", example="400"),
     *                  @OA\Property(property="code", type="string", example="0"),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="REQUEST:VALIDATION_ERROR"),
     *                  @OA\Property(property="message", type="string", example="Request validation failed"),
     *                  @OA\Property(property="status", type="string", example="422"),
     *                  @OA\Property(property="fields", type="object",
     *                      @OA\Property(property="name_vi", type="array",
     *                          @OA\Items(type="string", example="The name vi has already been taken."),
     *                      ),
     *                      @OA\Property(property="name_en", type="array",
     *                          @OA\Items(type="string", example="The name en has already been taken."),
     *                      ),
     *                  ),
     *             ),
     *         )
     *     ),
     * ),
     */
    public function store(TagRequest $request): JsonResponse
    {
        $tag                 = $this->tagService->store($request->all());
        $response['data']    = new TagResource($tag);
        $response['message'] = __('message.common.create.success');

        return $this->success($response, true);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     * @throws ApiException
     * @throws Exception
     * @OA\Get(
     *     path="/tag/{id}",
     *     operationId="Tag detail",
     *     tags={"Tags"},
     *     summary="Tag detail",
     *     description="Get detail of the tag by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="tags.id"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *                     @OA\Property(property="name_en", type="string", example="Cheap price"),
     *                     @OA\Property(property="status", type="string", example="display"),
     *                     @OA\Property(property="created_at", type="string", example="2024-01-27 03:59:45"),
     *                     @OA\Property(property="updated_at", type="string", example="2024-01-27 03:59:45"),
     *                 ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found response",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="NOT FOUND"),
     *                  @OA\Property(property="message", type="string", example="Not found"),
     *                  @OA\Property(property="status", type="string", example="404"),
     *                  @OA\Property(property="code", type="string", example="0"),
     *             ),
     *         )
     *     ),
     * ),
     */
    public function show(string $id): JsonResponse
    {
        $response['data'] = new TagResource(
            $this->tagService->show($id)
        );

        return $this->success($response);
    }

    /**
     * Update the specified resource in storage.
     * @param TagRequest $request
     * @param int|null $id
     * @return JsonResponse
     * @throws Exception
     * @OA\Patch(
     *     path="/tag/{id}",
     *     operationId="Update Tag",
     *     tags={"Tags"},
     *     summary="Update Tag",
     *     security={{"bearer": {}}},
     *     description="Update tag",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="tags.id"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Body data",
     *        @OA\JsonContent(
     *             @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *             @OA\Property(property="name_en", type="string", example="Cheap price"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Giá rẻ"),
     *                     @OA\Property(property="name_en", type="string", example="Cheap price"),
     *                     @OA\Property(property="status", type="string", example="display"),
     *                     @OA\Property(property="created_at", type="string", example="2024-01-27 03:59:45"),
     *                     @OA\Property(property="updated_at", type="string", example="2024-01-27 03:59:45"),
     *                 ),
     *             ),
     *             @OA\Property(property="message", type="string", example="Updated successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found response",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="NOT FOUND"),
     *                  @OA\Property(property="message", type="string", example="Not found"),
     *                  @OA\Property(property="status", type="string", example="404"),
     *                  @OA\Property(property="code", type="string", example="0"),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="REQUEST:VALIDATION_ERROR"),
     *                  @OA\Property(property="message", type="string", example="Request validation failed"),
     *                  @OA\Property(property="status", type="string", example="422"),
     *                  @OA\Property(property="fields", type="object",
     *                      @OA\Property(property="name_vi", type="array",
     *                          @OA\Items(type="string", example="The name vi has already been taken."),
     *                      ),
     *                      @OA\Property(property="name_en", type="array",
     *                          @OA\Items(type="string", example="The name en has already been taken."),
     *                      ),
     *                  ),
     *             ),
     *         )
     *     ),
     * ),
     */
    public function update(TagRequest $request, ?int $id): JsonResponse
    {
        $tag                 = $this->tagService->update($id, $request->all());
        $response['data']    = new TagResource($tag);
        $response['message'] = __('message.common.update.success');

        return $this->success($response, true);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     * @OA\Delete(
     *     path="/tag/{id}",
     *     operationId="Delete Tag",
     *     tags={"Tags"},
     *     summary="Delete Tag",
     *     security={{"bearer": {}}},
     *     description="Delete tag by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="tags.id"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found response",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="object",
     *                  @OA\Property(property="name", type="string", example="NOT FOUND"),
     *                  @OA\Property(property="message", type="string", example="Not found"),
     *                  @OA\Property(property="status", type="string", example="404"),
     *                  @OA\Property(property="code", type="string", example="0"),
     *             ),
     *         )
     *     ),
     * ),
     */
    public function destroy(string $id): JsonResponse
    {
        $response['success'] = $this->tagService->destroy($id);
        $response['message'] = __('message.common.delete.success');

        return $this->success($response, true);
    }
}
