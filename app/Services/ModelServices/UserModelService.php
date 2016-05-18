<?php

namespace App\Services\ModelServices;

use Auth;
use App\Interfaces\SearchableModelService;
use App\Models\User;

class UserModelService implements SearchableModelService
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    public function getSearchResults($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "*$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return User::searchByQuery($query);
    }

    public function searchResultString()
    {
        return 'User: ' . $this->user->name . ' (' . ($this->user->curator ? 'Curator' : 'Contributor') . ')';
    }

    public function searchResultUrl()
    {
        return '/u/' . $this->user->slug;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-user"></i>';
    }
}
