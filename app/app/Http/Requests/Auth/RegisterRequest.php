<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Models\User\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique(app(User::class)->getTable())
                    ->ignore($this->email)
                    ->whereNotNull('email_verified_at'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'confirm_password'  => 'same:password',
        ];
    }

    /**
     * Get the attributes that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes(): array
    {
        return [
            'email'    => __('label.user.field.email'),
            'password' => __('label.user.field.password'),
            'confirm_password' => __('label.user.field.confirm_password')
        ];
    }
}
