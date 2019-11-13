<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session', function (Blueprint $table) {
            $table->bigIncrements('s_id');
            $table->string('title')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_attendance');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->boolean('is_full');
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
        Schema::dropIfExists('session');
    }
}
