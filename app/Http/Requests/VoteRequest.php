<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'votable_type' => ['required', 'string', Rule::in(['post', 'comment'])],
            'votable_id' => ['required', 'uuid'], // or 'integer' if you don’t use UUIDs
            'is_upvote' => ['required', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'votable_type' => strtolower($this->input('votable_type')),
        ]);
    }
}
