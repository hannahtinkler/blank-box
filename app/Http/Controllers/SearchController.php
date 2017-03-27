<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SearchService;

class SearchController extends Controller
{
    private $search;
    
    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function performSearch(Request $request, $term)
    {
        if (empty($term)) {
            return $ajax ? json_encode([]) : [];
        }

        $searchables = config('elasticquent.searchables');

        return $this->search->process($term, $searchables);
    }
    
    public function showSearchResults(Request $request, $term)
    {
        $results = $this->performSearch($request, $term);

        return view('search.results', [
            'results' => $results,
            'searchTerm' => $term
        ]);
    }
}
