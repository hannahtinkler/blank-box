<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\SearchableRepository;

class UserRepository implements SearchableRepository
{
    /**
     * @var User
     */
    private $user;
    
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function searchResultString()
    {
        $string = 'User: ' . $this->user->name;

        if (env('FEATURE_CURATION_ENABLED') && $this->user->curator) {
            $string .= '(Curator)';
        }

        return $string;
    }

    /**
     * @return string
     */
    public function searchResultUrl()
    {
        return sprintf('/u/%s', $this->user->slug);
    }

    /**
     * @return string
     */
    public function searchResultIcon()
    {
        return '<i class="fa fa-user"></i>';
    }
}
