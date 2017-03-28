<?php

namespace App\Http\Controllers;

use App\Services\SearchService;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $search;
    
    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    /**
     * @param  Request $request
     * @param  string  $term
     * @return string
     */
    public function performSearch(Request $request, $term)
    {
        $searchables = config('elasticquent.searchables');

        return json_encode(
            $this->search->process($term, $searchables)
        );
    }
    
    /**
     * @param  string  $term
     * @return View
     */
    public function showSearchResults($term)
    {
        $searchables = config('elasticquent.searchables');
        
        $results = $this->search->process($term, $searchables);

        return view('search.results', [
            'results' => $results,
            'searchTerm' => $term
        ]);
    }
}
