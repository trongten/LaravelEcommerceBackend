<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noctice_details', function (Blueprint $table) {
            $table->unsignedBigInteger('noctice_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('noctice_details', function (Blueprint $table) {
            $table->foreign('noctice_id')->references('id')->on('noctices');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noctice_details');
    }
};
