<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'image' => 'required|image|max:5120', // max 5MB
            'post_id' => 'required|uuid|exists:posts,id',
        ];
    }
}
