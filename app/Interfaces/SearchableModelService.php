<?php

namespace App\Interfaces;

interface SearchableModelService
{
    public function getSearchResults($term);
    public function searchResultString();
    public function searchResultUrl();
    public function searchResultIcon();
}
