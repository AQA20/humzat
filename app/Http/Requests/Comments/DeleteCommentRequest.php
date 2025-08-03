<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class DeleteCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->comment->user_id === Auth::id();
    }

    public function rules(): array
    {
        return [];
    }
}
