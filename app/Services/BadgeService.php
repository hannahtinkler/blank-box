<?php

namespace App\Services;

use DB;
use Event;

use App\Models\Badge;
use App\Models\UserBadge;

use App\Events\BadgeWasAddedToUser;

class BadgeService
{
    /**
     * @return Collection
     */
    public function getAll()
    {
        return Badge::orderBy('badge_type_id')->get();
    }

    /**
     * @param  int $id
     * @return Badge
     */
    public function getById($id)
    {
        return Badge::findOrFail($id);
    }

    /**
     * @param  int $userId
     * @return Collection
     */
    public function getByUserId($userId)
    {
        return Badge::select('badges.*')
            ->join('user_badges', 'badges.id', '=', 'user_badges.badge_id')
            ->where('user_badges.user_id', $userId)
            ->orderBy('badges.created_at', 'DESC')
            ->get();
    }

    /**
     * @param  int $userId
     * @return Badge
     */
    public function getBestByUserId($userId)
    {
        return Badge::select('badges.*')
            ->join('user_badges', 'badges.id', '=', 'user_badges.badge_id')
            ->where('user_badges.user_id', $userId)
            ->orderBy('badges.level', 'DESC')
            ->orderBy('user_badges.created_at', 'DESC')
            ->first();
    }

    /**
     * @param  int $userId
     * @param  string $metric
     * @param  int $count
     * @return Collection
     */
    public function getNewByUserId($userId, $metric, $count)
    {
        return Badge::select('badges.*')
            ->join('badge_types', 'badges.badge_type_id', '=', 'badge_types.id')
            ->where('badge_types.metric', '=', $metric)
            ->where('badges.metric_boundary', '<=', $count)
            ->whereNotIn('badges.id', function ($query) use ($userId) {
                $query->select('badge_id')
                  ->from('user_badges')
                  ->where('user_id', $userId);
            })
            ->orderBy('badges.metric_boundary')
            ->get();
    }

    /**
     * @param int $userId
     * @param int $badgeId
     */
    public function addOneForUser($userId, $badgeId)
    {
        $badge = UserBadge::create([
            'user_id' => $userId,
            'badge_id' => $badgeId
        ]);

        Event::fire(new BadgeWasAddedToUser($badge));
    }

    /**
     * @param int $userId
     * @param int $newBadges
     */
    public function addManyForUser($userId, $newBadges)
    {
        foreach ($newBadges as $badgeId) {
            $this->addOneForUser($userId, $badgeId);
        }
    }

    /**
     * @param  int $userId
     * @return UserBadge
     */
    public function markAllAsSeen($userId)
    {
        return UserBadge::where('read', false)
            ->where('user_id', $userId)
            ->update(['read' => true]);
    }
    
    /**
     * @param  int $userId
     * @param  int $badgeId
     * @return boolean
     */
    public function userHasBadge($userId, $badgeId)
    {
        return (bool) UserBadge::where('user_id', $userId)
            ->where('badge_id', $badgeId)
            ->first();
    }
}
