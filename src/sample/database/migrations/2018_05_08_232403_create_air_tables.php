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
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->smallInteger('dive_time');
            $table->smallInteger('entry_pressure');
            $table->smallInteger('exit_pressure');
            $table->decimal('average_depth', 3, 1);
            $table->tinyInteger('tank_capacity');
            $table->decimal('minute_air', 5, 2);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));            
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('session_id', 100)->nullable();
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
