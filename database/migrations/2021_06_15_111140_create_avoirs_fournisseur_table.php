<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvoirsFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('avoire__f_s', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fournisseur')->index();
            $table->string('numero_commande');
            $table->date('date_avoire');
            $table->timestamps();
        });
        Schema::create('ligne_avoire__f_s', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_produit');
            $table->integer('quantite');
            $table->unsignedBigInteger('id_avoire');
            $table->foreign('id_avoire')
            ->references('id')->on('avoire__f_s')
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
        Schema::dropIfExists('avoire__f_s');
         Schema::dropIfExists('ligne_avoire__f_s');
    }
}
