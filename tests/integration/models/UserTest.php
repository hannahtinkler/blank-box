<?php

use App\Models\User;
use App\Models\Server;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchResultStringIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = 'User: ' . $user->name . ' (' . ($user->curator ? 'Curator' : 'Contributor') . ')';
        $actual = $user->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultUrlIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = '/u/' . $user->slug;
        $actual = $user->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    public function testSearchResultIconIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = '<i class="fa fa-user"></i>';
        $actual = $user->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
