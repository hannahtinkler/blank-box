<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    public $faker;

    /**
     * @var array
     */
    public $comparableFields = [];

    /**
     * @var string
     */
    protected $baseUrl = 'http://blank-box.app';

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

        $this->mockObservers();
        $this->truncateElasticSearch();
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
    
    /**
     * Mocks a the observer passed into the IOC so that this is tested in
     * isolation from the Elasticsearch model watchers
     *
     * @return void
     */
    public function mockObservers()
    {
        foreach (config('elasticquent.searchables') as $searchable) {
            $observer = sprintf('App\Observers\Elasticsearch\%sObserver', $searchable);

            $mock = Mockery::mock($observer);

            $mock->shouldReceive('created')->andReturn(true);
            $mock->shouldReceive('updated')->andReturn(true);
            $mock->shouldReceive('deleted')->andReturn(true);

            $this->app->instance($observer, $mock);
        }
    }

    public function truncateElasticSearch()
    {
        return file_get_contents(
            "http://localhost:9200/" . env('ELASTICSEARCH_INDEX'),
            false,
            stream_context_create(
                [
                    'http' => [
                        ['method' => 'DELETE']
                    ]
                ]
            )
        );
    }
}
