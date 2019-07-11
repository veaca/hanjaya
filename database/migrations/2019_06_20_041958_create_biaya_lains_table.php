<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiayaLainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_lains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bulan');
            $table->string('tahun');
            $table->bigInteger('gaji');
            $table->bigInteger('bpjs');
            $table->bigInteger('bank');
            $table->bigInteger('listrik');
            $table->bigInteger('pdam');
            $table->bigInteger('biaya_lain');
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
        Schema::dropIfExists('biaya_lains');
    }
}
