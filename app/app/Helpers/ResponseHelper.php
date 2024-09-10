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
            'data' => is_object($object) ? $object->items() : [],
            'pagination' => [
                'total'         => $object->total() ?? 0,
                'page'          => $object->currentPage() ?? 1,
                'total_pages'   => $object->total()
                    ? (
                        $object->total() == 0
                            ? 0
                            : $object->lastPage()
                    ) : 1,
                'page_size'     => $object->perPage()
                    ?? Common::getPageSize($request)['page_size'],
            ],
            'filter' => [
                'created_at_after'  => Common::validDate($request['created_at_after'] ?? null),
                'created_at_before' => Common::validDate($request['created_at_before'] ?? null),
                'id_after'          => $request['id_after'] ?? null,
            ]
        ];
    }

    /**
     * Full response with author response
     *
     * @param array $response
     * @param object|null $data
     * @param bool $hasPermission
     * @return array
     */
    public static function fullResponse(
        array $response = [],
        object $data = null,
        bool $hasPermission = false
    ): array
    {
        $author = [];
        if ($hasPermission) :
            $author = [
                'created_by' => $data->created_by ?? null,
                'updated_by' => $data->updated_by ?? null,
                'deleted_by' => $data->deleted_by ?? null,
            ];
        endif;

        return array_merge($response, $author);
    }
}
