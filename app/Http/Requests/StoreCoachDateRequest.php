<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreCoachDateRequest extends FormRequest
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
            'experience_years' => ['integer', 'max:50', 'required'],
            'about' => ['string', 'max:255', 'required'],
            'certificate_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
            'user_id' => ['integer', 'exists:user,id', 'required']
        ];
    }
}
