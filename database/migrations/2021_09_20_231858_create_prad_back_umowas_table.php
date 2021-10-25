<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePradBackUmowasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prad_back_umowas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_client');
            $table->integer('firmadostawca');
            $table->integer('taryfa');
            $table->decimal('volumen');
            $table->decimal('ppe');
            $table->integer('terendystrybucja');
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
        Schema::dropIfExists('prad_back_umowas');
    }
}
