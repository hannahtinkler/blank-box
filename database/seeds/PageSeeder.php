<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Chapter;
use App\Library\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serverChapter = Chapter::where('slug', 'mayden-servers')->first();
        $serviceChapter = Chapter::where('slug', 'iaptus-services')->first();

        Page::truncate();

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server List',
            'content' => null,
            'slug' => str_slug('Server List'),
            'order' => 1
        ]);

        Page::create([
            'chapter_id' => $serviceChapter->id,
            'title' => 'Service List',
            'content' => null,
            'slug' => str_slug('Service List'),
            'order' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Map',
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">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</div>
</div></div>
<script type="text/javascript" src="https://www.draw.io/js/embed-static.min.js"></script>',
            'slug' => str_slug('Server Map'),
            'order' => 2
        ]);
    }
}
