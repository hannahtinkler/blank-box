<?php

function encodeForCkEditor($string)
{
    $search = "~<code>(.*?)</code>~is";
    preg_match_all($search, $string, $matches);

    foreach ($matches[1] as $match) {
        $replace = htmlentities($match);
        $replace = preg_replace('#<br\s*/?>#i', "\n", $replace);
        $string = str_replace($match, $replace, $string);
    }
    
    $search = "~<pre>(.*?)</pre>~is";
    preg_match_all($search, $string, $matches);

    foreach ($matches[1] as $match) {
        $replace = htmlentities($match);
        $replace = preg_replace('#<br\s*/?>#i', "\n", $replace);
        $string = str_replace($match, $replace, $string);
    }


    return $string;
}
