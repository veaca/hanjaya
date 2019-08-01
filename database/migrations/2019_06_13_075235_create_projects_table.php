<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nop')->unique();
            $table->unsignedInteger('customer_id');
            $table->string('spk');
            $table->string('asal');
            $table->string('tujuan');
            $table->bigInteger('tarif');
            $table->bigInteger('qty');
            $table->bigInteger('tarif_vendor');
            $table->bigInteger('nilai_project');
            $table->bigInteger('biaya_lain')->nullable();
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
        Schema::dropIfExists('project');
    }
}
