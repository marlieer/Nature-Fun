<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRegistration extends Migration
{
    public function up()
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->unsignedInteger('c_id')->nullable()->change();
            $table->string('child_name')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('phone')->nullable();
             $table->string('allergy_info')->nullable();
            $table->string('notes')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('registration', function (Blueprint $table) {
            //
        });
    }
}
