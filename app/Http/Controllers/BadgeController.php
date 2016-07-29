<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BadgeGroup;

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
        $userBadges = $this->controllerService->getBadgesForUser();

        $badgeGroups = BadgeGroup::all();

        return view('badges.index', compact('badgeGroups', 'userBadges'));
    }
}
