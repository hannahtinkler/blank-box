<?php

namespace Tests\Unit\Requests;

use TestCase;

use App\Http\Requests\PageDraftRequest;

class PageDraftRequestTest extends TestCase
{
    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the PageDraftDraftControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = new PageDraftRequest;
    }

    /**
     * Tests that the call to the method which returns request validation
     * rules returns the expected rules array
     *
     * @return void
     */
    public function testItReturnsValidationRules()
    {
        $expected = [
            'chapter_id' => 'numeric',
            'title' => 'min:5',
            'description' => 'min:10',
            'content' => 'min:10',
        ];

        $actual = $this->request->rules();

        $this->assertEquals($expected, $actual);
    }
}
