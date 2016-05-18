<?php

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServerControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    public $user;

    /**
     * Test that a request to the route that shows a user the 'Server Details'
     * Page works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowServerDetailsPage()
    {
        $this->logInAsUser();

        $this->get('/p/mayden/servers/server-details')
            ->see('Server Details')
            ->assertResponseStatus(200);
    }
    
    /**
     * Test that a request to the route that shows a user the 'Server Details
     * modal works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessServerModalView()
    {
        $this->logInAsUser();

        $server = factory(App\Models\Server::class)->create();

        $this->get('/ajax/modal/server/' . $server->id)
            ->see(ucwords($server->node_type) . ': ' . $server->name)
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that shows a user the 'Config
     * Generator' Page works and returns a 200 response code (OK)
     *
     * @return void
     */
    public function testItCanAccessShowConfigGeneratorPage()
    {
        $this->logInAsUser();

        $this->get('/p/mayden/servers/ssh-config-generator')
            ->see('SSH Config Generator')
            ->assertResponseStatus(200);
    }

    /**
     * Test that a request to the route that downloads a config file fails
     * when not given the correct data and returns errors
     *
     * @return void
     */
    public function testItCanNotDownloadSshConfigFilePageWithNoData()
    {
        $this->logInAsUser();

        $this->post('/p/mayden/servers/ssh-config-generator', [
                '_token' => csrf_token(),
            ])
            ->assertResponseStatus(302);
        
        $this->assertSessionHasErrors();
    }

    /**
     * Logs in a new user so that we can path successfully though
     * authentication
     *
     * @return void
     */
    public function logInAsUser($overrides = [])
    {
        $this->user = factory(App\Models\User::class)->create($overrides);
        $this->be($this->user);
    }
}
