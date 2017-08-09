<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title', 255);
            $table->boolean('is_active', 0);
            $table->string('url', 255);
            $table->string('valid_method', 64);
            $table->text('expects');
            $table->text('emails');
            $table->timestamps();
        });

        Schema::table('services', function (Blueprint $table) {
           $table->foreign('user_id')
               ->references('id')
               ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
