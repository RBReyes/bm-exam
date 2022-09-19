<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThingsToDo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('things_to_do', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->longText('description');
            $table->string('banner')->nullable();
            $table->string('add_banner')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('category_id');
            $table->integer('city_id');
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
        Schema::dropIfExists('things_to_do');
    }
}
