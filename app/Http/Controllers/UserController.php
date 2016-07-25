<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Services\ControllerServices\PageDraftControllerService;

class UserController extends Controller
{
    private $pageDraftControllerService;
    private $user;

    public function __construct(Request $request, PageDraftControllerService $pageDraftControllerService)
    {
        $this->user = $request->user();
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('users.show', compact('user'));
    }
}
