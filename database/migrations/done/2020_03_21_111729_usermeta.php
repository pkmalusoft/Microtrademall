<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usermeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermeta', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('user_id');
            $table->string('investTypes')->nullable;
            $table->string('investAmount')->nullable;
            $table->string('loanAmount')->nullable;
            $table->string('services')->nullable;
            $table->string('introduction')->nullable;
            $table->string('businessType')->nullable;
            $table->integer('franchiser')->nullable;
            $table->string('franchiseeType')->nullable;
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
        //
    }
}
