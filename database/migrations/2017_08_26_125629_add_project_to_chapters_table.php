<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectToChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->boolean('projects_chapter')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('projects_chapter');
        });
    }
}
