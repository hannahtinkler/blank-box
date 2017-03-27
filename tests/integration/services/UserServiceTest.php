<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\UserService;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

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
}
