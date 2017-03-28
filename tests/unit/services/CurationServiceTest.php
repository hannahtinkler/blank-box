<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\TagService;
use App\Services\CurationService;

class CurationServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testItCanGetDiff()
    {

        $page1 = factory('App\Models\SuggestedEdit')->create([
            'title' => 'Doloremque voluptas eveniet quod ullam.',
            'description' => 'Eum sint voluptatibus autem.',
            'content' => 'Nulla harum dicta ipsa recusandae. Distinctio nisi quidem maiores ad quaerat. Cum quibusdam magnam dolores voluptates.',
        ]);

        $page2 = factory('App\Models\Page')->create([
            'title' => 'Suscipit pariatur quam quasi sit quisquam sit sequi.',
            'description' => 'Quibusdam quasi dignissimos fugit odit voluptatem placeat officia.',
            'content' => 'Quasi aliquam eos at saepe dolores. Quibusdam est necessitatibus nam reprehenderit magnam ut et. Fugit eum quis et ipsum. Cumque dolorem ut excepturi enim velit et.',
        ]);

        $service = new CurationService(new TagService);

        $expected = [
            'category' => '<del>' . $page1->chapter->category->title . '</del><ins>' . $page2->chapter->category->title . '</ins>',
            'chapter' => '<del>' . $page1->chapter->title . '</del><ins>' . $page2->chapter->title . '</ins>',
            'title' => "<del>Doloremque voluptas eveniet quod ullam.</del><ins>Suscipit pariatur quam quasi sit quisquam sit sequi.</ins>",
            'description' => "<del>Eum sint voluptatibus autem.</del><ins>Quibusdam quasi dignissimos fugit odit voluptatem placeat officia.</ins>",
            'content' => "<p><del>Nulla harum dicta ipsa recusandae. Distinctio nisi quidem maiores ad quaerat. Cum quibusdam magnam dolores voluptates.</del><ins>Quasi aliquam eos at saepe dolores. Quibusdam est necessitatibus nam reprehenderit magnam ut et. Fugit eum quis et ipsum. Cumque dolorem ut excepturi enim velit et.</ins></p>
",
            'tags' => '',
        ];

        $actual = $service->getPageDiff($page1, $page2);

        $this->assertEquals($expected, $actual);
    }
}
