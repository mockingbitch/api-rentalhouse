<?php

namespace App\Http\Requests\Room;

use App\Enum\General;
use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class RoomRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->method && $this->method == General::REQUEST_METHOD_DRAFT) :
            return [
                'house_id'          => 'required|exists:houses,id',
                'name'              => 'string|max:100',
                'description'       => 'string|max:1000',
                'images'            => 'image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=500,min_height=500,max_width=4000,max_height=4000',
                'capacity'          => 'numeric|min:1',
                'floor'             => 'numeric|min:1',
                'size'              => 'numeric|min:1',
                'apartment_type'    => 'nullable',
                'current_condition' => 'nullable',
                'price'             => 'numeric|min:0',
                'type'              => 'nullable',
                'tags.*'            => 'nullable',
                'more'              => 'string',
            ];
        endif;

        return [
            'house_id'          => 'required|exists:houses,id',
            'name'              => 'required|string|max:100',
            'description'       => 'string|max:1000',
            'images'            => 'required|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=500,min_height=500,max_width=4000,max_height=4000',
            'capacity'          => 'numeric|min:1',
            'floor'             => 'numeric|min:1',
            'size'              => 'numeric|min:1',
            'apartment_type'    => 'required',
            'current_condition' => 'required',
            'price'             => 'numeric|min:0',
            'type'              => 'required',
            'tags.*'            => 'required',
            'more'              => 'string',
        ];
    }
}
