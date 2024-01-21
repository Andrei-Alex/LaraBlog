<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

/**
 * Trait HandleSlug
 *
 * Provides functionality to handle slug generation for models.
 *
 * This trait is used to automatically generate a URL-friendly slug. If a slug is provided,
 * it uses that slug; otherwise, it generates one from the provided title.
 */
trait HandleSlug
{
    /**
     * Prepare the data for validation and slug generation.
     *
     * This method is used to modify the request data before it gets validated.
     * It ensures that a slug is set for the model. If the slug is not explicitly provided,
     * it generates one using the title.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
        ]);
    }
}
