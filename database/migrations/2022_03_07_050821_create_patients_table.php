<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('patient_id');
            $table->string('name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('tpa_id')->nullable();
            $table->string('tpa_validity')->nullable();
            $table->string('allergy')->nullable();
            $table->string('nid')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
