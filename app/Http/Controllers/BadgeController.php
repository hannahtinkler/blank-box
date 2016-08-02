<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Badge;
use App\Models\UserBadge;
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
        UserBadge::where('read', false)->update(['read' => true]);
        
        $user = User::where('slug', $userSlug)->firstOrFail();

        $userBadges = array_pluck($this->controllerService->getBadgesForUser($user->id)->toArray(), 'id');

        $badgeGroups = BadgeGroup::all();

        return view('badges.index', compact('badgeGroups', 'userBadges', 'user'));
    }

    public function showBadgeModal($id)
    {
        $badge = Badge::findOrFail($id);
        $earned = $this->controllerService->userHasBadge($id);
        
        return view('partials.badgemodal', compact('badge', 'earned'));
    }
}
