<?php

namespace App\Interfaces;

interface SearchableRepository
{
    public function searchResultString();
    public function searchResultUrl();
    public function searchResultIcon();
}
