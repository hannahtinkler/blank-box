<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\FeedEventService;

class FeedEventServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanGetAllFeedEventsPaginated()
    {
        $event = factory('App\Models\FeedEvent')->create();

        $service = new FeedEventService;

        $expected = [
            'total' => 1,
            'per_page' => 20,
            'current_page' => 1,
            'last_page' => 1,
            'next_page_url' => null,
            'prev_page_url' => null,
            'from' => 1,
            'to' => 1,
            'data' => [
                $event->toArray()
            ]
        ];

        $actual = $service->getAllPaginated()->toArray();

        $this->assertEquals($expected, $actual);
    }
}
