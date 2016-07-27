<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Models\UserBadge;

class UserBadgeControllerService
{
    public $user;

    public function addABadgeForUser($userId, $badgeId)
    {
        return UserBadge::create([
            'user_id' => $userId,
            'badge_id' => $badgeId
        ]);
    }

    public function addBadgesForUser($userId, $newBadges)
    {
        foreach ($newBadges as $badge) {
            $this->addABadgeForUser($userId, $badge->id);
        }
    }
}
