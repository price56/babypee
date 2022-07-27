<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithDrawRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).{8,32}$/',
        ];
    }
}
