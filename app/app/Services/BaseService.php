<?php

namespace App\Services;

use App\Core\Logger\Log;
use App\Enum\General;
use App\Helpers\Common;
use App\Helpers\ResponseHelper;
use App\Repositories\BaseRepository;
use Exception;
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
     * @return array
     * @throws Exception
     */
    public function list(array $request = []): array
    {
        $page     = Common::getPageSize($request)['current_page'];
        $pageSize = Common::getPageSize($request)['page_size'];
        try {
            /** @var Array_ $condition */
            $condition = [];
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
                && auth()->user()->role == General::ROLE_ADMIN
            ) :
                $condition = [
                    'status' => $request['status'],
                ];
            else :
                $condition = [
                    'status' => 1,
                ];
            endif;
            $data = $this->repository->query()
                ->where($condition)
                ->orderBy('id', General::SORT_DESC)
                ->paginate($pageSize, ['*'], 'page', $page);

            return ResponseHelper::list($data, $request);
        } catch (Exception $exception) {
            Log::error('error', $exception->getMessage());

            return ResponseHelper::list([], $request);
        }
    }
}
