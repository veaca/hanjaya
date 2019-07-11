<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('NOP');
            $table->bigInteger('jumlah_ongkos');
            $table->string('jenis_tambahan');
            $table->bigInteger('jumlah_tambahan');
            $table->bigInteger('potongan_pph');
            $table->bigInteger('jumlah_dibayar');
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
        Schema::dropIfExists('notas');
    }
}
