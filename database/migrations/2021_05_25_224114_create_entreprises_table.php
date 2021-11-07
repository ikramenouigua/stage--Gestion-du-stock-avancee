<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('raison_sociale');
            $table->string('adresse');
            $table->string('tele');
            $table->string('site_web');
            $table->string('ICE'); 
            $table->string('RC');
            $table->string('IF');
            $table->string('CNSS');
            $table->string('description');
            $table->string('logo');
            $table->date('date_creation');
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
        Schema::dropIfExists('entreprises');
    }
}
