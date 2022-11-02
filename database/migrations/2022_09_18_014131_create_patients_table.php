<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('lastname',50);
            $table->integer('dni');
            $table->string('phone',9);
            $table->string('email',60);
            $table->date('date_birth')->nullable();
            $table->enum('status',['ACTIVE','LOCKED'])->default('ACTIVE');
            $table->string('father_fullname',200);
            $table->string('mother_fullname',200);
            $table->integer('father_dni')->nullable();
            $table->integer('mother_dni')->nullable();
            $table->string('gender',45);
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
        Schema::dropIfExists('patients');
    }
}
