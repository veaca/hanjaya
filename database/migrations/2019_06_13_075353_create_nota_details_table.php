<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('nota_id');
            $table->string('nopol');
            $table->bigInteger('kg');
            $table->bigInteger('ongkos');
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
        Schema::dropIfExists('nota_details');
    }
}
