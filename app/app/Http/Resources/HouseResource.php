<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
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
            'lessor'         => $this->lessor ?? null,
            'description'    => $this->description ?? null,
            'address'        => $this->address ?? null,
            'thumbnail'      => $this->thumbnail ?? null,
            'category'       => $this->category ?? null,
            'verified_at'    => $this->verified_at ?? null,
            'status'         => $this->status ?? null,
            'created_by'     => $this->created_by ?? null,
            'updated_by'     => $this->updated_by ?? null,
            'deleted_by'     => $this->deleted_by ?? null,
            'created_at'     => $this->created_at ?? null,
            'updated_at'     => $this->updated_at ?? null,
        ];
    }
}
