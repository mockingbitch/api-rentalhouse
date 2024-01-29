<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toResponse($request): array
    {
        return [
            'id'                => $this->id,
            'name_vi'           => $this->name_vi,
            'name_en'           => $this->name_en,
            'description_vi'    => $this->description_vi,
            'description_en'    => $this->description_en,
            'icon'              => $this->icon,
            'status'            => $this->status,
            'created_at'        => $this->created_at
        ];
    }
}
