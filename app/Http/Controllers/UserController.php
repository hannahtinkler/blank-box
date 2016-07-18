<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('users.show', compact('user'));
    }
}
