<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('gender');
            $table->tinyInteger('age');
            $table->smallInteger('dive_time');
            $table->smallInteger('entry_pressure');
            $table->smallInteger('exit_pressure');
            $table->tinyInteger('average_depth');
            $table->tinyInteger('tank_capacity');
            $table->decimal('minute_air', 4, 1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();;
            $table->string('session_id', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('air');
    }
}
