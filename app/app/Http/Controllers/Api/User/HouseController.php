<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Entities\HouseEntity;
use App\Http\Controllers\Controller;
use App\Http\Resources\HouseResource;
use App\Http\Requests\House\HouseRequest;
use App\Http\Requests\House\UpdateHouseRequest;
use App\Exceptions\ApiException;
use App\Services\HouseService;
use Exception;

class HouseController extends Controller
{
    /**
     * Constructor
     *
     * @param HouseService $houseService
     */
    public function __construct(
        protected HouseService $houseService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @OA\Get(
     *     path="/house",
     *     operationId="List Houses",
     *     tags={"Houses"},
     *     summary="List Houses",
     *     description="Get list of all houses",
     *     @OA\Parameter(
     *          name="name",
     *          in="header",
     *          required=false,
     *          @OA\Schema(type="string"),
     *          description="houses.name like %.name.%"
     *      ),
     *     @OA\Parameter(
     *           name="province_code",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="houses.province_code = province_code"
     *       ),
     *     @OA\Parameter(
     *           name="district_code",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="houses.district_code = district_code"
     *       ),
     *     @OA\Parameter(
     *           name="ward_code",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="houses.ward_code = ward_code"
     *       ),
     *     @OA\Parameter(
     *           name="category_id",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="houses.category_id = category_id"
     *       ),
     *     @OA\Parameter(
     *           name="status",
     *           in="header",
     *           required=false,
     *           @OA\Schema(type="string"),
     *           description="houses.status = status"
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
        $response = $this->houseService->listHouse($request->all());
        $data = [];
        foreach ($response['data'] as $item) {
            $house = new HouseEntity($item);
            $data[] = (new HouseResource($house))->toResponse($item);
        }
        $response['data'] = $data;

        return $this->success($response);
    }

    /**
     * Display the specified resource.
     *
     * @param string|null $id
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
    public function show(?string $id): JsonResponse
    {
        $house = new HouseEntity($this->houseService->show($id));
        $response['data'] = (new HouseResource($house))
            ->toResponse($this->houseService->show($id));

        return $this->success($response);
    }
}