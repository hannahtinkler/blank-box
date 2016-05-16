<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    public $faker;
    public $comparableFields = [];

    protected $baseUrl = 'http://black-box.app';

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

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }
    
    public function comparableFields($data)
    {
        return array_intersect_key($data, array_flip($this->comparableFields));
    }
}
