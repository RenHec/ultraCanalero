<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('names', 50);
            $table->string('surnames', 50);
            $table->string('email', 50)->unique();
            $table->string('phone', 10)->unique();
            $table->string('whatsapp', 10)->unique();
            $table->string('telegram', 10)->unique();
            $table->date('birthday');
            $table->boolean('information')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('person');
    }
}
