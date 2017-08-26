<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->text('type')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page_resources');
    }
}
