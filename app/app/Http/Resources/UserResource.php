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
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'role'          => $this->role,
            'biography'     => $this->biography,
            'avatar'        => $this->avatar,
            'birthday'      => $this->birthday,
            'ward'          => $this->ward,
            'district'      => $this->district,
            'province'      => $this->province,
            'ward_code'     => $this->ward_code,
            'district_code' => $this->district_code,
            'province_code' => $this->province_code,
            'full_address'  => $this->full_address,
            'region'        => $this->region,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
        ];
    }
}
