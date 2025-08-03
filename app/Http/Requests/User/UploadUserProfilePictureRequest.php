<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UploadUserProfilePictureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:3072', // Max 3MB (in kilobytes)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => 'The profile picture must not exceed 3MB.',
        ];
    }
}
