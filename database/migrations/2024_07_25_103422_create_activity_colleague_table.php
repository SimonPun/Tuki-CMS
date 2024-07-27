<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityColleagueTable extends Migration
{
    public function up()
    {
        Schema::create('activity_colleague', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_colleague');
    }
}
