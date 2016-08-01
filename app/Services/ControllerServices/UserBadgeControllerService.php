<?php

namespace App\Services\ControllerServices;

use Illuminate\Http\Request;

use App\Events\BadgeWasAddedToUser;

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
        $badge = UserBadge::create([
            'user_id' => $this->user->id,
            'badge_id' => $badgeId
        ]);

        \Event::fire(new BadgeWasAddedToUser($badge->badge));

        return $badge;
    }

    public function addBadgesForUser($newBadges)
    {
        foreach ($newBadges as $badge) {
            $this->addABadgeForUser($badge->id);
        }
    }
    
    public function userHasBadge($id)
    {
        $badge = UserBadge::where('user_badges.user_id', $this->user->id)
            ->where('user_badges.badge_id', $id)
            ->first();

        return is_object($badge);
    }

    public function getBadgesForUser()
    {
        return Badge::select('badges.*')
            ->leftJoin('user_badges', 'badges.id', '=', 'user_badges.badge_id')
            ->where('user_badges.user_id', $this->user->id)
            ->orderBy('badges.created_at', 'DESC')
            ->get();
    }
}
