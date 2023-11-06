<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latetimes', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('stu_id')->unsigned();
            $table->time('duration');
            $table->date('latetime_date');

            $table->foreign('stu_id')->references('id')->on('students')->onDelete('cascade');

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
        
        Schema::table('latetimes', function (Blueprint $table) {
            $table->dropForeign(['stu_id']);
           });
   

        Schema::dropIfExists('latetimes');
    }
}
