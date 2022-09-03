<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->unique();
            $table->string('address', 250)->nullable();
            $table->unsignedBigInteger('industry_id')->unsigned()->nullable();
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('industry_id')
            ->references('id')->on('industries')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
