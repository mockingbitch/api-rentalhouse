<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Get list pagination
     *
     * @param array|object $object
     * @param array $request
     * @return array
     */
    public static function list(array|object $object, array $request = []): array
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
}
