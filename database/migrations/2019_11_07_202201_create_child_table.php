<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('allergy_info')->nullable();
            $table->string('notes')->nullable();
            $table->date('birthdate');
            $table->boolean('can_take_photos');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('child');
    }
}
