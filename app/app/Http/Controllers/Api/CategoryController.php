<?php

namespace App\Http\Controllers\Api;

use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Constructor
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryService $categoryService
     */
    public function __construct(
        public CategoryRepositoryInterface $categoryRepository,
        protected CategoryService $categoryService,
    ) {
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        return $this->success(
            $this->categoryService->index((array) $request)
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $response['data']    = new CategoryResource(
                $this->categoryService->store($request->all())
            );
            $response['message'] = __('message.common.create.success');

            return $this->success($response, true);
        } catch (Exception $exception) {
            return $this->exception($exception, true);
        }
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     * @throws ApiException
     * @throws Exception
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
     * @param CategoryRequest $request
     * @param int|null $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(CategoryRequest $request, ?int $id): JsonResponse
    {
        try {
            $response['data']    = new CategoryResource(
                $this->categoryService->update($id, $request->all())
            );
            $response['message'] = __('message.common.update.success');

            return $this->success($response, true);
        } catch (Exception $exception) {
            return $this->exception($exception, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $response['success'] = $this->categoryService->destroy($id);
            $response['message'] = __('message.common.delete.success');

            return $this->success($response, true);
        } catch (Exception $exception) {
            return $this->exception($exception, true);
        }
    }
}
