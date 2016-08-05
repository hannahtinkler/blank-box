<?php

use App\Events\ContributorWasAdded;

class ContributorWasAddedTest extends TestCase
{
    public function testItReturnsCorrectProperties()
    {
        $contributor = factory(App\Models\Contributor::class)->create();

        $expected = $contributor;
        $actual = (new ContributorWasAdded($contributor))->contributor;
        $this->assertEquals($expected, $actual);
    }
}
