<?php

namespace Tests\Integration\Services;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\CategoryService;

class CategoryServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetCategoryById()
    {
        $category = factory('App\Models\Category')->create();

        $service = new CategoryService;

        $expected = $category->toArray();

        $actual = $service->getById($category->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetCategoryBySlug()
    {
        $category = factory('App\Models\Category')->create();

        $service = new CategoryService;

        $expected = $category->toArray();

        $actual = $service->getBySlug($category->slug)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetFirstCategory()
    {
        $service = new CategoryService;

        $expected = [
            'id' => 1,
            'title' => "General",
            'description' => "General chapters go here.",
            'slug' => "general",
            'order' => 1,
            'created_at' => "2017-03-26 17:47:11",
            'updated_at' => "2017-03-26 17:47:11",
        ];

        $actual = $service->getFirst()->toArray();

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

    public function testItCanGetCurrentCategoryBySession()
    {
        $service = new CategoryService;

        $category = factory('App\Models\Category')->create();

        session()->set('currentCategoryId', $category->id);

        $expected = [
            'id' => $category->id,
            'title' => $category->title,
            'description' => $category->description,
            'slug' => $category->slug,
            'order' => $category->order,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
        ];

        $actual = $service->getCurrent()->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetCurrentCategoryByDefault()
    {
        $service = new CategoryService;

        $category = factory('App\Models\Category')->create();

        $expected = [
            'id' => $category->id,
            'title' => $category->title,
            'description' => $category->description,
            'slug' => $category->slug,
            'order' => $category->order,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
        ];

        $actual = $service->getCurrent($category->id)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetCurrentCategoryWhereUnset()
    {
        $service = new CategoryService;

        $expected = [
            'id' => 1,
            'title' => "General",
            'description' => "General chapters go here.",
            'slug' => "general",
            'order' => 1,
            'created_at' => "2017-03-26 17:47:11",
            'updated_at' => "2017-03-26 17:47:11",
        ];

        $actual = $service->getCurrent()->toArray();

        $this->assertEquals($expected, $actual);
    }
}
