<?php

use App\Models\ServerPortForwardingSetting;
use App\Models\User;
use App\Models\Server;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerPortForwardingSettingTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the server relationship returns the server that
     * this page belongs to
     *
     * @return void
     */
    public function testServerRelationshipReturnsServer()
    {
        $forwardingSetting = factory(ServerPortForwardingSetting::class)->create();
        $this->assertTrue($forwardingSetting->server instanceof Server);
    }
    
    /**
     * Tests that a call to the method that returns the search result string
     * for a given record works as expected
     *
     * @return void
     */
    public function createAndLoginAUser($overrides = [])
    {
        $user = factory(User::class)->create($overrides);
        Auth::login($user);

        return $user;
    }
}
