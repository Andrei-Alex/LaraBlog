<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait HandleSlug
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
        ]);
    }
}
