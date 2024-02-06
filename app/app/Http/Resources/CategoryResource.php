<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'                => $this->id ?? null,
            'name_vi'           => $this->name_vi ?? null,
            'name_en'           => $this->name_en ?? null,
            'description_vi'    => $this->description_vi ?? null,
            'description_en'    => $this->description_en ?? null,
            'icon'              => $this->icon ?? null,
            'status'            => $this->status ?? null,
            'created_at'        => $this->created_at ?? null
        ];
    }
}
