<?php

namespace App\Http\Controllers;

use App\Services\RankingService;

class RankingController extends Controller
{
    /**
     * @var RankingService
     */
    private $rankings;

    /**
     * @param RankingService $rankings
     */
    public function __construct(RankingService $rankings)
    {
        $this->rankings = $rankings;
    }
    
    /**
     * @return View
     */
    public function index()
    {
        $ranked = $this->rankings->getAllRankings();

        return view('rank.index', compact('ranked'));
    }
}
