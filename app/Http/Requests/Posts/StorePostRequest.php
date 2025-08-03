<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Enums\PostType;

class StorePostRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string'],
            'external_url' => ['nullable', 'url', 'max:2048'],
            'type' => ['required', Rule::in(array_map(fn($case) => $case->value, PostType::cases()))],
            'meta' => ['nullable', 'array'],
            'meta.tags' => ['nullable', 'array'],
            'meta.tags.*' => ['string', 'max:30', 'distinct'],
        ];
    }
}
