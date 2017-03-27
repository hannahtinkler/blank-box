<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page;
use App\Traits\Sluggable;

class SluggableTest extends TestCase
{
    use DatabaseTransactions, Sluggable;

    public function testItCanGetFirstSlugWhenUnique()
    {
        $expected = 'slug';

        $actual = $this->getSlug(Page::class, 'slug');

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetIncrementedSlugWhenNotUnique()
    {
        factory('App\Models\Page')->create(['slug' => 'slug']);
        factory('App\Models\Page')->create(['slug' => 'slug-1']);

        $expected = 'slug-2';

        $actual = $this->getSlug(Page::class, 'slug');

        $this->assertEquals($expected, $actual);
    }

    public function testItCanRegisterNewSlugAndUpdateOldOnes()
    {
        factory('App\Models\SlugForwardingSetting')->create([
            'old_slug' => 'older',
            'new_slug' => 'old',
        ]);

        $actual = $this->registerNewSlug('old', 'new');
        
        $this->seeInDatabase('slug_forwarding_settings', [
            'old_slug' => 'old',
            'new_slug' => 'new',
        ]);
        
        $this->seeInDatabase('slug_forwarding_settings', [
            'old_slug' => 'older',
            'new_slug' => 'new',
        ]);
    }

    public function testItCanSeeSlugExists()
    {
        factory('App\Models\Page')->create(['slug' => 'slug']);

        $actual = $this->slugExists(Page::class, 'slug');

        $this->assertTrue($actual);
    }

    public function testItCanSeeSlugDoesNotExists()
    {
        $actual = $this->slugExists(Page::class, 'slug');

        $this->assertFalse($actual);
    }
}
