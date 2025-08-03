<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;


class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body' => 'required|string|max:5000',
            'post_id' => 'required|uuid|exists:posts,id',
            'parent_id' => 'nullable|uuid|exists:comments,id',
        ];
    }
}
