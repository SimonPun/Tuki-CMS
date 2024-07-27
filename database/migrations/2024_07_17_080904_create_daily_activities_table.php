<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('title');
            $table->string('check_in')->nullable();
            $table->string('checkout')->nullable();
            $table->string('colleague_id')->nullable();
            $table->string('work_status')->nullable()->default('0');
            $table->text('work_list')->nullable();
            $table->text('finished_work')->nullable();
            $table->text('remaining_work')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_activities');
    }
}