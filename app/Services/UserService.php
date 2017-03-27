<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * @param  string $slug
     * @return User
     */
    public function getBySlug($slug)
    {
        return User::where('slug', $slug)->firstOrFail();
    }
}
