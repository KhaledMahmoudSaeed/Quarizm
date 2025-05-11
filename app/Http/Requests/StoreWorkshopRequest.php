<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreWorkshopRequest extends FormRequest
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
            'title' => ['required', 'max:60', 'string'],
            "description" => ["required", "string", "max:255"],
            'duration' => ['required', 'min:1', 'max:10', 'integer'],
            'size' => ['required', 'min:1', 'max:200', 'numeric'],
            'price' => ['required', 'numeric'],
            "date" => ['required', 'date_format:Y-m-d\TH:i'],
            "finish" => ['required', 'boolean'],
            'user_id' => ['integer', 'exists:user,id', 'required'],
            'category_id' => ['integer', 'exists:category,id', 'required'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ];
    }
}
