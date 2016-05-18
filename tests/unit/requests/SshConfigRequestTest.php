<?php

use App\Http\Requests\SshConfigRequest;

class SshConfigRequestTest extends TestCase
{
    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the SshConfigManager class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = new SshConfigRequest;
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
            'ssh_username' => 'required|min:3',
            'bracknell_key' => 'required|min:3',
            'bournemouth_key' => 'required|min:3'
        ];

        $actual = $this->request->rules();

        $this->assertEquals($expected, $actual);
    }
}
