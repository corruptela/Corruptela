<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFederativeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federative_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('initials',60);
            $table->integer('oficialid');
            $table->integer('countries_id')->unsigned();
            $table->foreign('countries_id')
            ->references('id')
            ->on('countries');
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
        Schema::dropIfExists('federative_units');
    }
}
