<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\Searchable;

class SearchRepository
{
    private $term;
    private $allResults = array();

    public function __construct($term)
    {
        $this->term = $term;
    }

    public function processSearch(array $searchables)
    {
        foreach ($searchables as $searchable) {
            $searchable = 'App\Library\Repositories\\'. $searchable . 'Repository';
            $class = new $searchable;
            $newResults = $this->getResults($class);
            $this->allResults = array_merge($this->allResults, $newResults);
        }

        return $this->formatResults();
    }

    private function getResults(Searchable $class)
    {
        return $class->getSearchResults($this->term);
    }

    private function formatResults()
    {
        $formatted = [];
        foreach ($this->allResults as $result) {
            $formatted[] = [
                'content' => $result['content'],
                'url' => $result['url']
            ];
        }

        return $formatted;
    }
}
