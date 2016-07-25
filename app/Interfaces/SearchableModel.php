<?php

namespace App\Interfaces;

interface SearchableModel
{
    public function searchResultString();
    public function searchResultUrl();
}
