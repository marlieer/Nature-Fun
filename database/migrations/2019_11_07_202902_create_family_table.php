<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family', function (Blueprint $table) {
            $table->bigIncrements('f_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('emerg_contact')->nullable();
            $table->string('emerg_phone')->nullable();
            $table->string('doctor')->nullable();
            $table->string('doc_phone')->nullable();
            $table->string('child_pickup')->nullable();
            $table->boolean('can_call_emerg')->nullable();
            $table->boolean('can_take_photos')->nullable();
            $table->string('custody_notes')->nullable();
            $table->boolean('iscustody')->nullable();

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
        Schema::dropIfExists('family');
    }
}
