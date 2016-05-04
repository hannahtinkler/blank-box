<?php

namespace App\Library\Interfaces;

interface SearchableRepository
{
    public function getSearchResults($term);
    public function searchResultString($result);
    public function searchResultUrl($result);
}
