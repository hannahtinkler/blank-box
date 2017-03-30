<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\UserService;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetUserById()
    {
        $service = new UserService;

        $expected = [
            'id' => 1,
            'name' => "Sarina Lowe",
            'email' => "gia.halvorson@example.com",
            'slug' => "sarina-lowe",
            'default_category_id' => 0,
            'curator' => 0,
            'remember_token' => "NCJfVdP5og",
            'created_at' => "2017-03-24 14:52:32",
            'updated_at' => "2017-03-24 14:52:32",
        ];

        $actual = $service->getById(1)->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetUserBySlug()
    {
        $service = new UserService;

        $expected = [
            'id' => 1,
            'name' => "Sarina Lowe",
            'email' => "gia.halvorson@example.com",
            'slug' => "sarina-lowe",
            'default_category_id' => 0,
            'curator' => 0,
            'remember_token' => "NCJfVdP5og",
            'created_at' => "2017-03-24 14:52:32",
            'updated_at' => "2017-03-24 14:52:32",
        ];

        $actual = $service->getBySlug('sarina-lowe')->toArray();

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetAllContributionTotals()
    {
        $page = factory('App\Models\Page')->create(['approved' => 1]);
        $edit = factory('App\Models\SuggestedEdit')->create(['approved' => 1]);

        $service = new UserService;

        $expected = [
            [
                'id' => $page->created_by,
                'name' => $page->creator->name,
                'total' => 3,
            ],
            [
                'id' => $edit->created_by,
                'name' => $edit->creator->name,
                'total' => 1,
            ],
            [
                'id' => 1,
                'name' => 'Sarina Lowe',
                'total' => 0,
            ],
        ];

        $actual = $service->getAllContributionTotals()->toArray();

        $this->assertEquals($expected, $actual);
    }
}
