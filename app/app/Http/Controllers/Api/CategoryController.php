<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Exceptions\ApiException;
use App\Services\CategoryService;
use Exception;

class CategoryController extends Controller
{
    /**
     * Constructor
     *
     * @param CategoryService $categoryService
     */
    public function __construct(
        protected CategoryService $categoryService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @OA\Get(
     *     path="/category",
     *     operationId="List Categories",
     *     tags={"Categories"},
     *     summary="List Categories",
     *     description="Get list of all categories",
     *     @OA\Parameter(
     *          name="name_vi",
     *          in="header",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          description="categories.name_vi like %.name_vi.%"
     *      ),
     *     @OA\Parameter(
     *           name="name_en",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="categories.name_en like %.name_en.%"
     *       ),
     *     @OA\Parameter(
     *         name="created_at_after",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="categories.created_at >= created_at_after"
     *     ),
     *     @OA\Parameter(
     *         name="created_at_before",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="categories.created_at <= created_at_before"
     *     ),
     *     @OA\Parameter(
     *         name="id_after",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="categories.id > id_after"
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
     *                     @OA\Property(property="name_vi", type="string", example="Nhà trọ"),
     *                     @OA\Property(property="name_en", type="string", example="Department"),
     *                     @OA\Property(property="description_vi", type="string", example="Nhà trọ cho thuê"),
     *                     @OA\Property(property="description_en", type="string", example="Department for rent"),
     *                     @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
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
            $this->categoryService->list($request->all())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Exception
     * @OA\Post(
     *     path="/category",
     *     operationId="Create Category",
     *     tags={"Categories"},
     *     summary="Create Category",
     *     security={{"bearer": {}}},
     *     description="Create new category",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Body data",
     *        @OA\JsonContent(
     *             @OA\Property(property="name_vi", type="string", example="Homestay"),
     *             @OA\Property(property="name_en", type="string", example="Homestay"),
     *             @OA\Property(property="description_vi", type="string", example="Homestay"),
     *             @OA\Property(property="description_en", type="string", example="Homestay"),
     *             @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Nhà trọ"),
     *                     @OA\Property(property="name_en", type="string", example="Department"),
     *                     @OA\Property(property="description_vi", type="string", example="Nhà trọ cho thuê"),
     *                     @OA\Property(property="description_en", type="string", example="Department for rent"),
     *                     @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
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
     *         description="Bad request",
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
    public function store(CategoryRequest $request): JsonResponse
    {
        $category            = $this->categoryService->store($request->all());
        $response['data']    = new CategoryResource($category);
        $response['message'] = __('message.common.create.success');

        return $this->success($response, true);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return JsonResponse
     * @throws ApiException
     * @throws Exception
     * @OA\Get(
     *     path="/category/{id}",
     *     operationId="Category detail",
     *     tags={"Categories"},
     *     summary="Category detail",
     *     description="Get detail of the category by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="categories.id"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Nhà trọ"),
     *                     @OA\Property(property="name_en", type="string", example="Department"),
     *                     @OA\Property(property="description_vi", type="string", example="Nhà trọ cho thuê"),
     *                     @OA\Property(property="description_en", type="string", example="Department for rent"),
     *                     @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
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
        $response['data'] = new CategoryResource(
            $this->categoryService->show($id)
        );

        return $this->success($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int|null $id
     * @return JsonResponse
     * @throws Exception
     * @OA\Patch(
     *     path="/category/{id}",
     *     operationId="Update Category",
     *     tags={"Categories"},
     *     summary="Update Category",
     *     security={{"bearer": {}}},
     *     description="Update category",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="categories.id"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Body data",
     *        @OA\JsonContent(
     *             @OA\Property(property="name_vi", type="string", example="Homestay"),
     *             @OA\Property(property="name_en", type="string", example="Homestay"),
     *             @OA\Property(property="description_vi", type="string", example="Homestay"),
     *             @OA\Property(property="description_en", type="string", example="Homestay"),
     *             @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name_vi", type="string", example="Nhà trọ"),
     *                     @OA\Property(property="name_en", type="string", example="Department"),
     *                     @OA\Property(property="description_vi", type="string", example="Nhà trọ cho thuê"),
     *                     @OA\Property(property="description_en", type="string", example="Department for rent"),
     *                     @OA\Property(property="icon", type="string", example="<svg>Icon svg <svg>"),
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
     *         description="Bad request",
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
    public function update(CategoryRequest $request, ?int $id): JsonResponse
    {
        $category            = $this->categoryService->update($id, $request->all());
        $response['data']    = new CategoryResource($category);
        $response['message'] = __('message.common.update.success');

        return $this->success($response, true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     * @OA\Delete(
     *     path="/category/{id}",
     *     operationId="Delete Category",
     *     tags={"Categories"},
     *     summary="Delete Category",
     *     security={{"bearer": {}}},
     *     description="Delete category by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="header",
     *         required=false,
     *         @OA\Schema(type="datetime"),
     *         description="categories.id"
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
        $response['success'] = $this->categoryService->destroy($id);
        $response['message'] = __('message.common.delete.success');

        return $this->success($response, true);
    }
}
