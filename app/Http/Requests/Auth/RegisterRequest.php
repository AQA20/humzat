<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:280',
        ];
    }
}
