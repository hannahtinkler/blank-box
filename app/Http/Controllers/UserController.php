<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;

class UserController extends Controller
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
     * @param  Request $request
     * @param  string  $slug
     * @return View
     */
    public function show(Request $request, $slug)
    {
        $user = $this->users->getBySlug($slug);

        return view('users.show', compact('user'));
    }
}
