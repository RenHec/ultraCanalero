<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_send', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email');
            $table->boolean('send')->default(false);
            $table->string('token')->nullable();
            $table->string('description')->nullable();
            $table->boolean('answer')->default(false);
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
        Schema::dropIfExists('email_send');
    }
}
