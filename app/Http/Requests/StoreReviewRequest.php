<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titolo' => ['required', 'string', 'max:255'],
            'voto' => ['required', 'integer', 'between:1,5'],
            'commento' => ['required', 'string'],
        ];
    }
}
