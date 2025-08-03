<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeletePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->post->user_id === Auth::id();
    }

    public function rules(): array
    {
        return [];
    }
}
