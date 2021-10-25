<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlientpradsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klientprads', function (Blueprint $table) {
            $table->id();
            $table->integer('firmadostawca');
            $table->integer('taryfa');
            $table->decimal('cennik');
            $table->decimal('volumen');
            $table->decimal('ppe');
            $table->integer('terendystrybucja');
            $table->integer('kampania');
            $table->integer('status');
            $table->integer('oferta');
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
        Schema::dropIfExists('klientprads');
    }
}
