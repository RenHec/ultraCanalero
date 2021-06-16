<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*public function up()
    {
        Schema::create('person_commission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('person');
            $table->foreignId('commission_id')->constrained('commission');
            $table->boolean('leader')->default(false);
            $table->string('firm')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*public function down()
    {
        Schema::dropIfExists('person_commission');
    }*/
}
