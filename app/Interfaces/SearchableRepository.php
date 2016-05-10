<?php

namespace App\Interfaces;

interface SearchableRepository
{
    public function getSearchResults($term);
    public function searchResultString($result);
    public function searchResultUrl($result);
}
