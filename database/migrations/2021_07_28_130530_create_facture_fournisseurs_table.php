<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('id_commande_fourni')->index();
            $table->foreign('id_commande_fourni')
            ->references('reference_commande')->on('commande_fournisseurs')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_fournisseur')->index()->increments();
            $table->foreign('id_fournisseur')
            ->references('id')->on('fournisseurs')
            ->onDelete('cascade');
            $table->date('date_facture');
            $table->string('etat_facture');
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
        Schema::dropIfExists('facture_fournisseurs');
    }
}
