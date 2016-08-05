<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\UserBadge;
use App\Services\ControllerServices\UserBadgeControllerService;

class UserBadgeControllerServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the UserBadgeControllerService class under test
     * @var object
     */
    private $controllerService;

    /**
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array(
        'badge_id',
        'user_id'
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the UserBadgeControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\Models\User::class)->create();

        $prophet = new Prophecy\Prophet;
        $prophecy = $prophet->prophesize('Illuminate\Http\Request');
        $prophecy->user()->willReturn($this->user);

        $this->controllerService = new UserBadgeControllerService($prophecy->reveal());
    }

    /**
     * Tests that a call to the method which adds a new user badge works
     *
     * @return void
     */
    public function testItCanAddABadgeForUser()
    {
        $badge = factory(App\Models\Badge::class)->create();

        $actual = $this->controllerService->addABadgeForUser($badge->id)->toArray();

        $expected = [
            'user_id' => $this->user->id,
            'badge_id' => $badge->id
        ];

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }

    /**
     * Tests that a call to the method which adds multiple new user badges works
     *
     * @return void
     */
    public function testItCanAddMultipleBadgesForUser()
    {
        $badges = factory(App\Models\Badge::class, 2)->create();

        $this->controllerService->addBadgesForUser($badges);

        $lookup = UserBadge::where('user_id', $this->user->id)->get();
        $actual = $lookup->first()->toArray();

        $expected = [
            'user_id' => $this->user->id,
            'badge_id' => $badges->first()->id
        ];

        $this->assertEquals(
            $this->comparableFields($expected),
            $this->comparableFields($actual)
        );
    }
}
