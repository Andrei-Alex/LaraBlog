<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Traits\HandleSlug;
use Illuminate\Validation\Rule;


class FormPostRequest extends FormRequest
{
    use HandleSlug;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:8'],
            'slug' => ['required', 'min:8', 'regex:/^[a-zA-Z0-9\-]+$/', Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['required', 'array', 'exists:tags,id'],
            'image' => ['image', 'max:2000'],

        ];
    }

}
