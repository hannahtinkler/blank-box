<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestedEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggested_edits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->integer('chapter_id');
            $table->string('title');
            $table->text('description');
            $table->text('content')->nullable();
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suggested_edits');
    }
}
