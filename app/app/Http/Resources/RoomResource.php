<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Response
     *
     * @param $request
     * @return array
     */
    public function toResponse($request): array
    {
        return [
            'id'             => $this->id ?? null,
            'name'           => $this->name ?? null,
//            'lessor'         => $this->lessor ?? null,
            'house'          => $this->house ?? null,
            'description'    => $this->description ?? null,
            'images'         => $this->images ?? null,
            'detail'         => $this->detail ?? null,
            'tags'           => $this->tags ?? null,
            'status'         => $this->status ?? null,
            'created_by'     => $this->created_by ?? null,
            'updated_by'     => $this->updated_by ?? null,
            'deleted_by'     => $this->deleted_by ?? null,
            'created_at'     => $this->created_at ?? null,
            'updated_at'     => $this->updated_at ?? null,
        ];
    }
}
