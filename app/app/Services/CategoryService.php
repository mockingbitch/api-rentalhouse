<?php

namespace App\Services;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Enum\General;
use App\Exceptions\ApiException;
use App\Helpers\Common;
use Exception;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    /**
     * List Category
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function index(array $request = []): array
    {
        $page       = Common::getPageSize($request)['current_page'];
        $pageSize   = Common::getPageSize($request)['page_size'];
        try {
            $condition = [];
            if (isset($request['user_id'])) :
                $condition = [
                    'user_id' => auth()->user()->id,
                ];
            endif;
            if (isset($request['name_vi'])) :
                $condition[] = [
                    'name_vi',
                    'like',
                    '%' . $request['name_vi'] . '%'
                ];
            endif;
            if (isset($request['reference_1'])) :
                $condition[] = [
                    'customer_reference_1',
                    $request['reference_1']
                ];
            endif;
            if (isset($request['created_at_after'])) :
                $condition[] = [
                    'created_at',
                    '>=',
                    Common::validDate($request['created_at_after'])
                ];
            endif;
            if (isset($request['created_at_before'])) :
                $condition[] = [
                    'created_at',
                    '<=',
                    Common::validDate($request['created_at_before'])
                ];
            endif;
            if (isset($request['id_after'])) :
                $condition[] = [
                    'id',
                    '>',
                    $request['id_after']
                ];
            endif;
            $categories = $this->categoryRepository->query()
                ->where($condition)
                ->orderBy('id', General::SORT_DESC)
                ->paginate($pageSize, ['*'], 'page', $page);

            return $this->getList($categories, $request);
        } catch (Exception $exception) {
            Log::error('error', $exception->getMessage());

            return $this->getList([], $request);
        }
    }

    /**
     * Create new category
     * @param array $request
     * @return mixed
     */
    public function store(array $request = []): mixed
    {
        return $this->categoryRepository->create($request);
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
     */
    public function update(int $id, array $request = []): mixed
    {
        return $this->categoryRepository->update($id, $request);
    }

    /**
     * Delete category
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
