<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class joinRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'mobile' => ['required'],
            'password' => 'required|confirmed|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).{8,32}$/',
        ];
    }

    public function joinUserData(): array
    {
        $userData = $this->only(['email', 'mobile', 'app_type', 'name', 'password']);
        $userData['app_type'] = getDeviceType();

        return $userData;
    }
}
