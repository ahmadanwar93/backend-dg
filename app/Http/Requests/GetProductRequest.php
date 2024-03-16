<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\ValidationRules\Rules\Delimited;

class GetProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'min:3'], // 3 characters default for the filtering
            'direction' => ['sometimes', 'required', Rule::in(['asc', 'desc'])],
            'category_id' => ['sometimes', 'required', (new Delimited('category_id|between:1,10'))] // bad practice to hard code the upper and lower limit, in case the category seeder changes
        ];
    }
}
