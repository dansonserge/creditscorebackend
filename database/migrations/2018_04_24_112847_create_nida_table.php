<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
         Schema::create('nida', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('dob');

            $table->string('names');

            $table->string('location');

            $table->string('personal_id');

           
            
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
         Schema::drop('nida');
    }
}
