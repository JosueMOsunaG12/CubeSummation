<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('x');
            $table->smallInteger('y');
            $table->smallInteger('z');
            $table->bigInteger('value');
            $table->integer('cubes_id')->unsigned();
            $table->foreign('cubes_id')
                  ->references('id')->on('cubes')
                  ->onDelete('cascade');
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
        Schema::drop('blocks');
    }
}
