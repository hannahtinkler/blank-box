<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * @param  string $slug
     * @return Category
     */
    public function getBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return Category::orderBy('title')->get();
    }
}
