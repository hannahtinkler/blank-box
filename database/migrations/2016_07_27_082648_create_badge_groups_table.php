<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('badge_type_id');
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('metric_entity')->nullable()->default(null);
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
        Schema::drop('badge_groups');
    }
}
