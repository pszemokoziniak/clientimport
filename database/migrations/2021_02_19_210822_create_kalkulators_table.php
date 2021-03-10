<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalkulatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalkulators', function (Blueprint $table) {
            $table->id();
            $table->integer('id_client');
            $table->integer('rachunek');
            $table->integer('cykl');
            $table->float('zuzycie');
            $table->float('zuzycieroczne');
            $table->float('moc');
            $table->integer('oszczednosc');
            $table->float('mocmodulow');
            $table->integer('iloscmodulow');
            $table->float('minpowskosny');
            $table->float('minpowgrunt');

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
        Schema::dropIfExists('kalkulators');
    }
}
