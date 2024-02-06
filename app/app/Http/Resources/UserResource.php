<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'            => $this->id ?? null,
            'first_name'    => $this->first_name ?? null,
            'last_name'     => $this->last_name ?? null,
            'email'         => $this->email ?? null,
            'phone'         => $this->phone ?? null,
            'role'          => $this->role ?? null,
            'biography'     => $this->biography ?? null,
            'avatar'        => $this->avatar ?? null,
            'birthday'      => $this->birthday ?? null,
            'ward'          => $this->ward ?? null,
            'district'      => $this->district ?? null,
            'province'      => $this->province ?? null,
            'ward_code'     => $this->ward_code ?? null,
            'district_code' => $this->district_code ?? null,
            'province_code' => $this->province_code ?? null,
            'full_address'  => $this->full_address ?? null,
            'region'        => $this->region ?? null,
            'status'        => $this->status ?? null,
            'updated_by'    => $this->updated_by ?? null,
        ];
    }
}
