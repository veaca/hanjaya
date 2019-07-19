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
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('project_id');
            $table->string('jenis_tambahan');
            $table->bigInteger('jumlah_tambahan');
            $table->string('nopol');
            $table->bigInteger('kg');
            $table->bigInteger('jumlah_pph');
            $table->bigInteger('ongkos_nota');
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
