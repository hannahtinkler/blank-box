<?php

use App\Events\BadgeWasAddedToUser;

class BadgeWasAddedToUserTest extends TestCase
{
    public function testItReturnsCorrectProperties()
    {
        $userBadge = factory(App\Models\UserBadge::class)->create();

        $expected = $userBadge;
        $actual = (new BadgeWasAddedToUser($userBadge))->badge;

        $this->assertEquals($expected, $actual);
    }
}
