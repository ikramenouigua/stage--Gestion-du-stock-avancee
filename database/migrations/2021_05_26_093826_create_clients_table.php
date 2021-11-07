<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('tel1');
            $table->integer('tel2');
            $table->string('email');
            $table->string('address1');
            $table->string('addresse2');
            $table->unsignedInteger('id_group_client')->index()->increments();
            $table->foreign('id_group_client')
            ->references('id')->on('group_clients')
            ->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
