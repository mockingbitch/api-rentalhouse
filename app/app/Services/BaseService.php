<?php

namespace App\Services;

use App\Enum\General;
use App\Helpers\Common;
use PhpParser\Node\Expr\Array_;

class BaseService
{
    /**
     * Get list pagination
     * @param array|object $object
     * @param array $request
     * @return array
     */
    protected function getList(array|object $object, array $request = []): array
    {
        return [
            'data' => $object->items() ?? [],
            'pagination' => [
                'total'         => $object->total() ?? 0,
                'page'          => $object->currentPage() ?? 1,
                'total_pages'   => $object->total() ? ($object->total() == 0 ? 0 : $object->lastPage()) : 1,
                'page_size'     => $object->perPage() ?? Common::getPageSize($request)['page_size'],
            ],
            'filter' => [
                'created_at_after'  => Common::validDate($request['created_at_after'] ?? null),
                'created_at_before' => Common::validDate($request['created_at_before'] ?? null),
                'id_after'          => $request['id_after'] ?? null,
            ]
        ];
    }

    /**
     * Build condition for get list api
     * @param array $request
     * @return array
     */
    public function buildCondition(array $request = []): array
    {
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

        return $condition;
    }
}
