<?php

namespace Tests\Integration\Services;

use TestCase;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetUserById()
    {
        $user = factory(User::class)->create();

        $service = new UserService;

        $actual = $service->getById($user->id)->toArray();

        $this->assertEquals($user->toArray(), $actual);
    }

    public function testItCanGetUserBySlug()
    {
        $user = factory(User::class)->create();

        $service = new UserService;

        $actual = $service->getBySlug($user->slug)->toArray();

        $this->assertEquals($user->toArray(), $actual);
    }

    public function testItCanGetAllContributionTotals()
    {
        $user = factory(User::class)->create();
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
                'id' => $user->id,
                'name' => $user->name,
                'total' => 0,
            ],
        ];

        $actual = $service->getAllContributionTotals()->toArray();

        $this->assertEquals($expected, $actual);
    }
}
