<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateRraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('rra', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('asset_name');
            $table->string('asset_id');
            $table->string('asset_owner_id');
            $table->string('asset_tax');

            
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
        Schema::drop('rra');
    }
}
