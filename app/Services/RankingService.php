<?php

namespace App\Services;

use App\Services\UserService;

class RankingService
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
     * @return array
     */
    public function getAllRankings()
    {
        $contribution = $this->users->getAllContributionTotals()->toArray();

        $ranked = [];

        foreach ($contribution as $key => $user) {
            $ranked[$user['name']] = [
                'slug' => $this->users->getById($user['id'])->slug,
                'rank' => $key + 1,
                'score' => $user['total']
            ];
        }
        
        return $ranked;
    }
}
