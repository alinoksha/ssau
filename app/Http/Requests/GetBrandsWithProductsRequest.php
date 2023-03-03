<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetBrandsWithProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'sort' => 'string|in:asc,desc',
            'page' => 'int|min:1',
            'per_page' => 'int|min:1|max:100',
        ];
    }
}
