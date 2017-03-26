<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getBySlug($slug)
    {
        return User::where('slug', $slug)->firstOrFail();
    }
}
