<?php

use App\Http\Requests\ChapterRequest;

class ChapterRequestTest extends TestCase
{
    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the ChapterControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = new ChapterRequest;
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
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required',
            'description' => 'required|min:10'
        ];

        $actual = $this->request->rules();

        $this->assertEquals($expected, $actual);
    }
}
