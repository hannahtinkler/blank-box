<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * @param  string $id
     * @return Category
     */
    public function getById($id)
    {
        return Category::where('id', $id)->firstOrFail();
    }

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
    public function getFirst()
    {
        return Category::first();
    }

    /**
     * @return Category
     */
    public function getCurrent($defaultCategoryId = null)
    {
        if (session()->has('currentCategoryId')) {
            $category = $this->getById(session()->get('currentCategoryId'));
        } else if ($defaultCategoryId) {
            $category = $this->getById($defaultCategoryId);
        } else {
            $category = $this->getFirst();
            session()->set('currentCategoryId', $category->id);
        }

        return $category;
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return Category::orderBy('title')->get();
    }
}
