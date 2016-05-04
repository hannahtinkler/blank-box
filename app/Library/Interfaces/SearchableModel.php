<?php

namespace App\Library\Interfaces;

interface SearchableModel
{
    public function __construct(array $attributes = array());
    public function searchResultString();
    public function searchResultUrl();
}
