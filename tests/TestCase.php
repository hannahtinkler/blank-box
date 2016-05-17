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

    /**
     * Calls the parent setUp() methods and creates an instance of Faker as a
     * property for future use
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }
    
    /**
     * Performs an intersect on the comparable fields property of the
     * extending class and the data passed in so that only the intersecting
     * fields are returned. It also sorts them so that fields can be appended
     * and still compared as equals (without order affecting it - as long as
     * the data is present, that is enough).
     *
     * @return void
     */
    public function comparableFields($data)
    {
        if (!empty($this->comparableFields)) {
            $data = array_intersect_key($data, array_flip($this->comparableFields));
        }
        
        ksort($data);
        return $data;
    }
}
