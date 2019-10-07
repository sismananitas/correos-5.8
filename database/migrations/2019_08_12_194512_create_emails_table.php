<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('emplea_id')->unsigned();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('delivered_to');
            $table->string('dependency');
            $table->string('type');
            $table->string('status');
            // $table->bigInteger('emailable_id')->unsigned();
            // $table->string('emailable_type');
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
        Schema::dropIfExists('emails');
    }
}
