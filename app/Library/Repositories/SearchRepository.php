<?php

namespace App\Library\Repositories;

use App\Library\Interfaces\SearchableRepository;

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
            $this->allResults[] = $newResults;
        }

        $this->formatResults();
        $this->sortResults();

        return $this->allResults;
    }

    private function getResults(SearchableRepository $class)
    {
        return $class->getSearchResults($this->term);
    }

    private function formatResults()
    {
        $formatted = [];
        foreach ($this->allResults as $resultSet) {
            foreach ($resultSet as $result) {
                $formatted[] = [
                    'content' => $result->searchResultString(),
                    'url' => $result->searchResultUrl(),
                    'score' => $result->documentScore()
                ];
            }
        }

        $this->allResults = $formatted;
    }

    private function sortResults()
    {
        usort($this->allResults, function($a, $b) {
            if ($a['score'] == $b['score']) {
                return 0;
            }

            return ($a['score'] < $b['score']) ? 1 : -1;
        });
    }
}
