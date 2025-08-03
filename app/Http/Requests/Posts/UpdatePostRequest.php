<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Usually, authorization is checked in the controller via policies,
     * so return true here.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * For update, fields are optional but if present must be valid.
     */
    public function rules(): array
    {
        return [
            'body' => ['sometimes', 'required', 'string'],
            'external_url' => ['nullable', 'url'],
            'meta' => ['nullable', 'array'],
            'meta.tags' => ['nullable', 'array'],
            'meta.tags.*' => ['string', 'max:30', 'distinct'],
        ];
    }
}
