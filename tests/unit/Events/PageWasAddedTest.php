<?php

namespace Tests\Unit\Events;

use TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Events\PageWasAdded;

class PageWasAddedTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testItReturnsCorrectProperties()
    {
        $page = factory('App\Models\Page')->create();
        $user = factory('App\Models\User')->create();

        $expected = $page;
        $actual = (new PageWasAdded($page, $user))->page;
        $this->assertEquals($expected, $actual);

        $expected = 'pagesSubmitted';
        $actual = (new PageWasAdded($page, $user))->metric;
        $this->assertEquals($expected, $actual);

    }
}
