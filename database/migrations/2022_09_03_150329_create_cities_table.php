<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->unsignedBigInteger('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->unique(['name', 'country_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
