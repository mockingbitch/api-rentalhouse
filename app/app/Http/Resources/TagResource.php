<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'id'                => $this->id,
            'name_vi'           => $this->name_vi,
            'name_en'           => $this->name_en,
            'description_vi'    => $this->description_vi,
            'description_en'    => $this->description_en,
            'status'            => $this->status,
            'created_at'        => $this->created_at
        ];
    }
}
