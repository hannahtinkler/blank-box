<?php

namespace App\Services\ModelServices;

use Laravel\Socialite\Two\GoogleProvider;

class SocialModelService
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
