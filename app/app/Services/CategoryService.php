<?php

namespace App\Services;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Exceptions\ApiException;
use Exception;

class CategoryService extends BaseService
{
    /**
     * Constructor
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->repository = $this->categoryRepository;
    }

    /**
     * Create new category
     * @param array $request
     * @return mixed
     * @throws ApiException
     * @throws Exception
     */
    public function store(array $request = []): mixed
    {
        if ($category = $this->categoryRepository->create($request)) :
            return $category;
        endif;
        Log::error('error', __('message.common.error.bad_request'));

        throw new ApiException(ErrorCodes::BAD_REQUEST);
    }

    /**
     * Show category detail
     * @param int $id
     * @return mixed
     * @throws ApiException
     */
    public function show(int $id): mixed
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) :
            throw new ApiException(
                ErrorCodes::NOT_FOUND,
                __('message.error.not_found')
            );
        endif;

        return $category;
    }

    /**
     * Update category
     * @param int $id
     * @param array $request
     * @return false|mixed
     * @throws ApiException
     */
    public function update(int $id, array $request = []): mixed
    {
        if ($category = $this->categoryRepository->update($id, $request)) :
            return $category;
        endif;

        throw new ApiException(ErrorCodes::NOT_FOUND);
    }

    /**
     * Delete category
     * @param int $id
     * @return bool
     * @throws ApiException
     */
    public function destroy(int $id): bool
    {
        if ($this->categoryRepository->delete($id)) :
            return true;
        endif;

        throw new ApiException(
            ErrorCodes::NOT_FOUND,
            __('message.error.not_found')
        );
    }
}
