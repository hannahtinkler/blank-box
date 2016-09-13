<?php

namespace App\Observers\Elasticsearch;

use App\Models\Chapter;
use Elasticsearch\Client;

class ChapterObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(Chapter $chapter)
    {
        $chapter->addToIndex();
    }

    public function updated(Chapter $chapter)
    {
        $chapter->addToIndex();
    }

    public function deleted(Chapter $chapter)
    {
        $this->elasticsearch->delete([
            'index' => env('ELASTICSEARCH_INDEX', 'default'),
            'type' => 'chapters',
            'id' => $chapter->id
        ]);
    }
}
