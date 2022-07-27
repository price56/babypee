<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BabyListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
