<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                "nullable",
                "string",
                "alpha:ascii",
                "max:100",
                Rule::unique(Category::class)->ignore($this->category()->id)
            ],
            "description" => [
                "nullable",
                "string",
                "alpha:ascii",
                "max:255"
            ]
        ];
    }
}
