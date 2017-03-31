<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\CategoryService;

class CategoryServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetCategoryBySlug()
    {
        $category = factory('App\Models\Category')->create();

        $service = new CategoryService;

        $expected = $category->toArray();

        $actual = $service->getBySlug($category->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllCategories()
    {
        $service = new CategoryService;

        $expected = [
            [
                'id' => 1,
                'title' => "General",
                'description' => "General chapters go here.",
                'slug' => "general",
                'order' => 1,
                'created_at' => "2017-03-26 17:47:11",
                'updated_at' => "2017-03-26 17:47:11",
            ]
        ];

        $actual = $service->getAll()->toArray();

        $this->assertEquals($expected, $actual);
    }
}
