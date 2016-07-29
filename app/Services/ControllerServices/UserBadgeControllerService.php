<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\Badge;
use App\Models\UserBadge;

class UserBadgeControllerService
{
    public $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function addABadgeForUser($badgeId)
    {
        return UserBadge::create([
            'user_id' => $this->user->id,
            'badge_id' => $badgeId
        ]);
    }

    public function addBadgesForUser($newBadges)
    {
        foreach ($newBadges as $badge) {
            $this->addABadgeForUser($this->user->id, $badge->id);
        }
    }
    
    public function getBadgesForUser()
    {
        return Badge::join('user_badges', 'badges.id', '=', 'user_badges.badge_id')
            ->where('user_badges.id', $this->user->id)
            ->orderBy('badges.created_at', 'DESC')
            ->get();
    }
}
