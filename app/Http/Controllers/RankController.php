<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;

class RankController extends Controller
{
    /**
     * @var UserService
     */
    private $users;

    /**
     * @param UserService $users
     */
    public function __construct(UserService $users)
    {
        $this->users = $users;
    }
    
    /**
     * @return View
     */
    public function index()
    {
        $ranked = $this->getFormattedRankings();

        return view('rank.index', compact('ranked'));
    }
    
    /**
     * @return array
     */
    private function getFormattedRankings()
    {
        $communityData = $this->users->getAllContributionTotals();

        $ranked = [];

        foreach ($communityData as $key => $user) {
            $ranked[$user['name']] = [
                'slug' => $this->users->getById($user['id'])->slug,
                'rank' => $key + 1,
                'score' => $user['total']
            ];
        }
        
        return $ranked;
    }
}
