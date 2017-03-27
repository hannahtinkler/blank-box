<?php

namespace App\Traits;

use App\Models\SlugForwardingSetting;

trait Sluggable
{
    /**
     * @param  Model $class
     * @param  string $string
     * @return string
     */
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

    /**
     * Update old slug forwarding settings for the old slug, and create new
     * one too
     *
     * @param  string $oldSlug
     * @param  string $newSlug
     * @return SlugForwardingSetting
     */
    public function registerNewSlug($oldSlug, $newSlug)
    {
        SlugForwardingSetting::where('new_slug', $oldSlug)->update(['new_slug' => $newSlug]);

        return SlugForwardingSetting::create([
            'old_slug' => $oldSlug,
            'new_slug' => $newSlug
        ]);
    }

    /**
     * @param  Model $class
     * @param  string $slug
     * @return boolean
     */
    public function slugExists($class, $slug)
    {
        return (bool) $class::where('slug', $slug)->first();
    }
}
