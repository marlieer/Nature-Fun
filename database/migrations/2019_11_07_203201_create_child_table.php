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
            $table->bigIncrements('c_id');
            $table->string('child_name');
            $table->string('med_num')->nullable();
            $table->string('allergy_info')->nullable();
            $table->string('notes')->nullable();
            $table->date('birthdate');
            $table->unsignedInteger('f_id');
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
