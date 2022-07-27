<?php

namespace App\Http\Requests;

use App\Enum\BowelType;
use Illuminate\Foundation\Http\FormRequest;

class BabyStoreRequest extends FormRequest
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

    public function getData(): array
    {
        return [
            'id' => $this->get('id'),
            'name' => $this->get('name'),
            'type' => $this->get('type'),
            'success_yn' => $this->get('success_yn'),
            'description' => $this->get('description'),
        ];
    }
}
