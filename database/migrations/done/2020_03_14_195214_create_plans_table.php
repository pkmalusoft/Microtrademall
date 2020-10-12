<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('title', 255)->unique();
            $table->string('services')->nullable();
            $table->integer('price');
            $table->integer('duration');
            $table->boolean('is_active')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plans');
    }
}
