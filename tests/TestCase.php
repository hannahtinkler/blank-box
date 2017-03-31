<?php

use Faker\Factory as Faker;
use Elasticsearch\ClientBuilder;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * @var Prophet
     */
    public $prophet;
    
    /**
     * @var string
     */
    public $faker;

    /**
     * @var string
     */
    public $baseUrl = 'http://blank-box.app';


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Calls the parent setUp() methods and creates an instance of Faker as a
     * property for future use
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker::create();
    }

    public function mock($class)
    {
        if (!$this->prophet) {
            $this->prophet = new Prophecy\Prophet;
        }

        return $this->prophet->prophesize($class);
    }
}
