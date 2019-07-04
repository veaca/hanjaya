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
            $table->Integer('gaji');
            $table->Integer('bpjs');
            $table->Integer('bank');
            $table->Integer('listrik');
            $table->Integer('pdam');
            $table->Integer('biaya_lain');
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
