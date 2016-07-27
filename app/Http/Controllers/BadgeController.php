<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Badge;

use App\Services\ControllerServices\UserBadgeControllerService;

class BadgeController extends Controller
{
    private $controllerService;

    public function __construct(UserBadgeControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function index(Request $request, $userSlug)
    {
        $badges = Badge::join('user_badges', 'badges.id', '=', 'user_badges.badge_id')
            ->join('users', 'user_badges.user_id', '=', 'users.id')
            ->where('users.slug', $userSlug)
            ->orderBy('badges.created_at', 'DESC')
            ->get();

        return view('badges.index', compact('badges'));
    }
}
