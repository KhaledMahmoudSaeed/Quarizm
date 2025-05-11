<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class UpdateWorkshopRequest extends FormRequest
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
            'title' => ['nullable', 'max:60', 'string'],
            "description" => ["nullable", "string", "max:255"],
            'duration' => ['nullable', 'min:1', 'max:10', 'integer'],
            'size' => ['nullable', 'min:1', 'max:200', 'numeric'],
            'price' => ['nullable', 'numeric'],
            "date" => ['nullable', 'date_format:Y-m-d\TH:i'],
            "finish" => ['nullable', 'boolean'],
            'user_id' => ['integer', 'exists:user,id', 'nullable'],
            'category_id' => ['integer', 'exists:category,id', 'nullable'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ];
    }
}
