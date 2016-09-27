<?php

function encodeFromCkEditor($string)
{
    $search = "~<code>(.*?)</code>~is";
    preg_match_all($search, $string, $matches);

    foreach ($matches[1] as $match) {
        $replace = str_replace('&amp;', '&', $match);
        $replace = htmlentities($replace);
        $replace = preg_replace('#<br\s*/?>#i', "\n", $replace);
        $string = str_replace($match, $replace, $string);
    }
    
    $search = "~<pre>(.*?)</pre>~is";
    preg_match_all($search, $string, $matches);

    $i = 0;
    foreach ($matches[1] as $match) {
        $replace = str_replace('&amp;', '&', $match);
        $replace = htmlentities($replace);
        $replace = preg_replace('#<br\s*/?>#i', "\n", $replace);
        $string = str_replace($match, $replace, $string);
        $i++;
    }


    return $string;
}

function decodeFromCkEditor($string)
{
    $string = html_entity_decode($string);
    $search = '~data-mxgraph="{(.*?)}">~is';
    preg_match_all($search, $string, $matches);

    foreach ($matches[1] as $match) {
        $replace = htmlentities($match);

        $quoteSearch = '~=&quot;(.*?)&quot;~is';
        preg_match_all($quoteSearch, $replace, $quoteMatches);

        foreach ($quoteMatches[0] as $quoteMatch) {
            $quoteReplace = str_replace('&quot;', '\&quot;', $quoteMatch);
            $replace = str_replace($quoteMatch, $quoteReplace, $replace);
        }

        $string = str_replace($match, $replace, $string);
    }

    return $string;
}
