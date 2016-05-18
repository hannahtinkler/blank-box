<?php

use App\Http\Requests\PageRequest;

class PageRequestTest extends TestCase
{
    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the PageDraftControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = new PageRequest;
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
            'chapter_id' => 'required|integer|exists:chapters,id',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'content' => 'required|min:10'
        ];

        $actual = $this->request->rules();

        $this->assertEquals($expected, $actual);
    }
}
