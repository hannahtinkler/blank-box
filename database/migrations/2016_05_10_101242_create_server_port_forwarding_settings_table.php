<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerPortForwardingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_port_forwarding_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id');
            $table->integer('source_port_number');
            $table->integer('target_port_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('server_port_forwarding_settings');
    }
}
