<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->Increments('id')->unsigned();
            $table->string('slug')->unique();
            $table->time('time_in');
            $table->time('time_out');

            $table->timestamps();
        });

        Schema::create('schedule_students', function (Blueprint $table) {
            $table->integer('stu_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
          

            $table->foreign('stu_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('schedule_students', function (Blueprint $table) {
            
            $table->dropForeign(['schedule_id']);
            $table->dropForeign(['stu_id']);
           });
     
        Schema::dropIfExists('schedule_students');
        Schema::dropIfExists('schedules');
    }
}
