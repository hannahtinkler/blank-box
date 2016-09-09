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
            $ranked[$user['name']] = [
                'slug' => $this->user->getByName($user['name'])->slug,
                'rank' => $rank + 1,
                'score' => $user['total']
            ];
        }
        
        return $ranked;
    }
}
