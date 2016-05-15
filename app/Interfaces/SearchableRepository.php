<?php

namespace App\Interfaces;

interface SearchableRepository
{
    public function getSearchResults($term);
    public function searchResultString();
    public function searchResultUrl();
    public function searchResultIcon();
}
