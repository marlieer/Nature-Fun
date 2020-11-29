<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('session_id');
            $table->foreign('session_id')->references('id')->on('session')->onDelete('cascade');
            $table->bigInteger('child_id')->nullable();
            $table->foreign('child_id')->references('id')->on('child')->onDelete('cascade');
            $table->boolean('is_paid')->nullable()->default(false);
            $table->string('child_name')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('allergy_info')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('registration');
    }
}
