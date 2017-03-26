<?php

namespace App\Traits;

trait Sluggable
{
    public function getSlug($class, $string)
    {
        $slug = str_slug($string);

        $exists = $this->slugExists($class, $slug);

        for ($i = 1; $exists; $i++) {
            $new = sprintf('%s-%d', $slug, $i);
            $exists = $this->slugExists($class, $new);
        }

        return isset($new) ? $new : $slug;
    }

    public function slugExists($class, $slug)
    {
        return (bool) $class::where('slug', $slug)->first();
    }
}
