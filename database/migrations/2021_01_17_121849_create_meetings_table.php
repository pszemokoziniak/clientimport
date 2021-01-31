<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('id_client');
            $table->date('meet_date');
            $table->string('size_instalation');
            $table->string('direct_world');
            $table->integer('type_agreement');
            $table->integer('type_installation');
            $table->bigInteger('price_instalation');
            $table->integer('chance_instalation');
            $table->text('meet_description');

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
        Schema::dropIfExists('meetings');
    }
}
