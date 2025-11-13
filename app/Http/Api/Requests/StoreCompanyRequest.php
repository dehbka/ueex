<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:256'],
            'edrpou' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string'],
        ];
    }
}
