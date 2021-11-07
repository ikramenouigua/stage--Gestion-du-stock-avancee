<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //la table commande
        Schema::create('commande_clients', function (Blueprint $table) {
            $table->id();
            $table->string('reference_commande')->unique();
            $table->date('date_cmd_client');
            $table->integer('total_produits');
            $table->double('remise');
            $table->double('prix_total');
            $table->string('etat_commande');
            $table->unsignedInteger('id_client')->index()->increments();
            $table->foreign('id_client')
            ->references('id')->on('clients')
            ->onDelete('cascade');
            $table->timestamps();
        });

        //La table ligne de commande
        Schema::create('lignecommandesclients', function (Blueprint $table) {
            $table->id();
            $table->string('id_commande_client')->index();
            $table->unsignedBigInteger('quantite_cmd');
            $table->double('prix_total');
            $table->double('total_tva');
            $table->double('total_ttc');
           
            $table->foreign('id_commande_client')
            ->references('reference_commande')->on('commande_clients')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_produit')->index();
            $table->foreign('id_produit')
            ->references('id')->on('products')
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
        Schema::dropIfExists('commandesclients');
        Schema::dropIfExists('lignecommandesclients');
    }
}
