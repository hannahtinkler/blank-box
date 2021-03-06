<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;
use App\Services\BadgeService;

class BadgeController extends Controller
{
    /**
     * @var BadgeService
     */
    private $badge;

    /**
     * @var UserService
     */
    private $users;

    /**
     * @var integer
     */
    private $badgesPerRow = 7;

    /**
     * @param BadgeService $badges
     * @param UserService  $user
     */
    public function __construct(BadgeService $badges, UserService $users)
    {
        $this->badges = $badges;
        $this->users = $users;
    }

    /**
     * @param  Request $request
     * @param  string  $slug
     * @return View
     */
    public function index(Request $request, $slug)
    {
        $me = $request->user();
        $user = $this->users->getBySlug($slug);

        if ($user->id == $me->id) {
            $this->badges->markAllAsSeen($me->id);
        }

        $userBadges = array_pluck(
            $this->badges->getByUserId($user->id)->toArray(),
            'id'
        );

        $badges = $this->badges->getAll();

        $badgesPerRow = $this->badgesPerRow;

        return view('badges.index', compact(
            'badges',
            'userBadges',
            'user',
            'badgesPerRow'
        ));
    }

    /**
     * @param  int $userId
     * @param  int $badgeId
     * @return View
     */
    public function showBadgeModal($userId, $badgeId)
    {
        $badge = $this->badges->getById($badgeId);

        $earned = $this->badges->userHasBadge($userId, $badgeId);

        return view('partials.badgemodal', compact('badge', 'earned'));
    }
}
