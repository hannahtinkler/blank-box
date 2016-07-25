<?php

namespace App\Services\ModelServices;

use Laravel\Socialite\Two\GoogleProvider;

class SocialModelService
{
    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderLogout($token)
    {
        return $this->graphUrl.'/'.$this->version.'/me/permissions?access_token='.$token;
    }
}
