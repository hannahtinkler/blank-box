<?php

namespace App\Repositories;

use Laravel\Socialite\Two\GoogleProvider;

class SocialRepository
{
    private $user;

    public function __construct()
    {
        $this->user = Socialite::driver('github')->user();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderLogout($token)
    {
        return $this->graphUrl.'/'.$this->version.'/me/permissions?access_token='.$access_token;
    }
}
