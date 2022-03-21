<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sys_group_id')->nullable();
            $table->string('staff_id')->unique()->nullable();
            $table->integer('desig_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_joining')->nullable();
            $table->string('current_address')->nullable();
            $table->string('perma_address')->nullable();
            $table->string('dob')->nullable();
            $table->tinyInteger('blood_group')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('qualification')->nullable();
            $table->longText('specialization')->nullable();
            $table->string('nid')->nullable();
            $table->string('reference_contact')->nullable();
            $table->string('epf_no')->nullable();
            $table->float('basic_salary')->nullable();
            $table->string('work_shift')->nullable();
            $table->string('work_location')->nullable();
            $table->string('contract_type')->nullable();
            $table->integer('casual_leave')->nullable();
            $table->integer('privilege_leave')->nullable();
            $table->integer('sick_leave')->nullable();
            $table->integer('maternity_leave')->nullable();
            $table->integer('paternity_leave')->nullable();
            $table->integer('fever_leave')->nullable();
            $table->string('acc_title')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('resume')->nullable();
            $table->string('joining_letter')->nullable();
            $table->string('other_document')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('password');
            $table->tinyInteger('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
