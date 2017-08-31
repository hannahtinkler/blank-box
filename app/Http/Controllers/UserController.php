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
        $currentUser = $request->user();
        $user = $this->users->getBySlug($slug);

        return view('users.show', compact('user', 'currentUser'));
    }

    /**
     * @param  Request $request
     * @return View
     */
    public function editStatus(Request $request)
    {
        $user = $request->user();

        return view('users.status', compact('user'));
    }

    /**
     * @param  Request $request
     * @return [type]
     */
    public function updateStatus(Request $request)
    {
        $user = $request->user();
        $user->status = strip_tags(
            $request->input('status'),
            '<a><i><strong>'
        );
        $user->save();

        return redirect('/u/' . $user->slug)->with(
            'message',
            '<i class="fa fa-check"></i> Your status has been updated successfully'
        );
    }
}
