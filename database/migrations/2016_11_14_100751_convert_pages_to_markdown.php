<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use League\HTMLToMarkdown\HtmlConverter;
use League\CommonMark\CommonMarkConverter;

class ConvertPagesToMarkdown extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            $converter = new HtmlConverter(['strip_tags' => true]);

            DB::table('pages')->chunk(100, function ($pages) use ($converter) {
                foreach ($pages as $page) {
                    $html = $page->content;
                    $markdown = $converter->convert($html);

                    DB::update('UPDATE pages SET content = ? WHERE id = ?', [$markdown, $page->id]);
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            $converter = new CommonMarkConverter();

            DB::table('pages')->chunk(100, function ($pages) use ($converter) {
                foreach ($pages as $page) {
                    $markdown = $page->content;
                    $html = $converter->convertToHtml($markdown);

                    DB::update('UPDATE pages SET content = ? WHERE id = ?', [$html, $page->id]);
                }
            });
        });
    }
}
