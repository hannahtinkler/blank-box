<?php

use App\Models\Service;
use App\Services\ModelServices\ServiceModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceModelServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current service being used in the test
     * @var object Service
     */
    public $service;

    /**
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $repository = $this->getServiceModelService();

        $expected = 'Service: ' . $this->service->name . ' (' . $this->service->service_id . ') - ' . $this->service->server->location . ' ' . $this->service->server->nickname;
        $actual = $repository->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the URL string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $repository = $this->getServiceModelService();

        $expected = '/p/iaptus/services/service-list/' . $this->service->id;
        $actual = $repository->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the icon html the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $repository = $this->getServiceModelService();

        $expected = '<i class="fa fa-group"></i>';
        $actual = $repository->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Create instance of ServiceModelService class
     *
     * @return void
     */
    private function getServiceModelService()
    {
        $this->service = factory(Service::class)->create();
        return new ServiceModelService($this->service);
    }
}
