<?php

namespace Tests\Unit\Events;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Events\BadgeWasAddedToUser;

class BadgeWasAddedToUserTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testItReturnsCorrectProperties()
    {
        $userBadge = factory('App\Models\UserBadge')->create();

        $expected = $userBadge;
        $actual = (new BadgeWasAddedToUser($userBadge))->badge;

        $this->assertEquals($expected, $actual);
    }
}
