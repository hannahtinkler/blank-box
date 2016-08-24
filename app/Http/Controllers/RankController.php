<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankController extends Controller
{
    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }
    
    public function index()
    {
        $ranked = $this->getRankings();
        return view('rank.index', compact('ranked'));
    }
    
    private function getRankings()
    {
        $communityData = $this->user->getRawCommunityData();
        $ranked = [];
        
        foreach ($communityData as $rank => $user) {
           $ranked[$user['name']] = $user['total'];
           $ranked[$user['name']] = $rank + 1;     
        }
        
        return $ranked;
    }
}
