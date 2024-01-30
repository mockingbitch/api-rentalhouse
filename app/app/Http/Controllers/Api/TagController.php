<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Exception;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    /**
     * Constructor
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(
        public TagRepositoryInterface $tagRepository,
    ) {
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        $response['data'] = $this->tagRepository->getAll();

        return $this->success($response);
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $data = $request->all();
        try {
            $response['data']       = new CategoryResource($this->tagRepository->create($data));
            $response['message']    = __('message.common.create.success');

            return $this->success($response, true);
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function show(string $id): JsonResponse
    {
        try {
            $response['data'] = new CategoryResource($this->categoryRepository->find($id));

            return $this->success($response);
        } catch (Exception $exception) {
            throw new ApiException(
                ErrorCodes::NOT_FOUND,
                __('message.error.not_found')
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryRequest $request
     * @param int|null $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function update(CategoryRequest $request, ?int $id): JsonResponse
    {
        $data = $request->all();
        try {
            $response['data']       = new CategoryResource($this->categoryRepository->update($id, $data));
            $response['message']    = __('message.common.update.success');

            return $this->success($response, true);
        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::REQUEST_BAD_REQUEST, $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $response['success'] = $this->categoryRepository->delete($id);
            $response['message'] = __('message.common.delete.success');

            return $this->success($response);
        } catch (Exception $exception) {
            throw new ApiException(ErrorCodes::REQUEST_BAD_REQUEST, $exception);
        }
    }
}
