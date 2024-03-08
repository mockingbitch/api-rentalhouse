<?php

namespace App\Services;

use App\Core\Logger\Log;
use App\Enum\ErrorCodes;
use App\Enum\General;
use App\Exceptions\ApiException;
use App\Helpers\Common;
use App\Helpers\ResponseHelper;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

abstract class BaseService
{
    /**
     * Main repository
     * @var BaseRepository;
     */
    protected BaseRepository $repository;

    /**
     * Handle dynamic method calls into the service.
     *
     * @param  mixed  $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(mixed $method, array $parameters)
    {
        return $this->repository->$method(...$parameters);
    }

    /**
     * Build common list
     *
     * @param array $request
     * @param array $relations
     * @return array
     * @throws Exception
     */
    public function list(array $request = [], array $relations = []): array
    {
        $page     = Common::getPageSize($request)['current_page'];
        $pageSize = Common::getPageSize($request)['page_size'];
        try {
            $condition = $this->buildCondition($request);
            if (isset($request['name_vi'])) :
                $condition[] = [
                    'name_vi',
                    'like',
                    '%' . $request['name_vi'] . '%'
                ];
            endif;
            if (isset($request['name_en'])) :
                $condition[] = [
                    'name_vi',
                    'like',
                    '%' . $request['name_en'] . '%'
                ];
            endif;
            $data = $this->repository->query()
                ->where($condition)
                ->with($relations)
                ->orderBy('id', General::SORT_DESC)
                ->paginate($pageSize, ['*'], 'page', $page);

            return ResponseHelper::list($data, $request);
        } catch (Exception $exception) {
            Log::error('error', $exception->getMessage());

            return ResponseHelper::list([], $request);
        }
    }

    /**
     * Create new resource
     *
     * @param array $request
     * @return mixed
     * @throws ApiException
     * @throws Exception
     */
    public function store(array $request = []): mixed
    {
        $request['created_by'] = auth()->user()->id ?? null;
        if ($result = $this->repository->create($request)) :
            return $result;
        endif;
        Log::error('error', __('message.common.error.bad_request'));

        throw new ApiException(ErrorCodes::BAD_REQUEST);
    }

    /**
     * Show resource detail
     *
     * @param string $id
     * @return mixed
     * @throws ApiException
     */
    public function show(string $id): mixed
    {
        $result = $this->repository->find($id);
        if (!$result) :
            throw new ApiException(
                ErrorCodes::NOT_FOUND,
                __('message.error.not_found')
            );
        endif;

        return $result;
    }

    /**
     * Update resource
     *
     * @param string $id
     * @param array $request
     * @return false|mixed
     * @throws ApiException
     */
    public function update(string $id, array $request = []): mixed
    {
        if ($result = $this->repository->update($id, $request)) :
            return $result;
        endif;

        throw new ApiException(
            ErrorCodes::NOT_FOUND,
            __('message.error.not_found')
        );
    }

    /**
     * Soft delete resource
     *
     * @param int $id
     * @return bool
     * @throws ApiException
     */
    public function destroy(int $id): bool
    {
        if ($result = $this->repository->softDelete($id)) :
            return $result;
        endif;

        throw new ApiException(
            ErrorCodes::NOT_FOUND,
            __('message.error.not_found')
        );
    }

    /**
     * Build Condition
     *
     * @param array $request
     * @return array|int[]
     */
    protected function buildCondition(array $request = []): array
    {
        /** @var Array_ $condition */
        $condition = [];
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
        if (
            isset($request['status'])
            && auth()->user()->role <= General::ROLE_MANAGER
        ) :
            $condition = [
                'status' => $request['status'],
            ];
        endif;
        if (!auth()->user() || auth()->user()->role > General::ROLE_MANAGER) :
            $condition = [
                'status' => General::STATUS_ACTIVE,
            ];
        endif;

        return $condition;
    }

    /**
     * Get Type master data
     * @param int $key
     * @param int|null $key_id
     * @return Model|Builder|Collection
     */
    public function getType(int $key, ?int $key_id): Model|Builder|Collection
    {
        $query = DB::table('types_mst')->where('key', $key);
        if ($key_id) :
            return $query->where('key_id', $key_id)->first();
        endif;

        return $query->get();
    }
}
