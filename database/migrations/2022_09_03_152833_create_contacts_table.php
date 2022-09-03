<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('value', 250)->unique();
            $table->unsignedBigInteger('customer_id')->unsigned();
            $table->unsignedBigInteger('contact_type_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('contact_type_id')
            ->references('id')->on('contact_types')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('customer_id')
            ->references('id')->on('customers')
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
        Schema::dropIfExists('contacts');
    }
}
