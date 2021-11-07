<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesFournisseursCommandes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
        public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fournisseur');
            $table->string('email')->unique();
            $table->string('tel');
            $table->timestamps();
        });
        //la table commande
        Schema::create('commande_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('reference_commande')->unique();
            $table->date('date_cmd_fournisseur');
            $table->integer('total_produits');
            $table->double('prix_total');
            $table->string('etat_commande');
            $table->unsignedBigInteger('id_fournisseur')->index()->increments();
            $table->foreign('id_fournisseur')
            ->references('id')->on('fournisseurs')
            ->onDelete('cascade');
            $table->timestamps();
        });

        //La table ligne de commande
        Schema::create('lignecommandes', function (Blueprint $table) {
            $table->id();
            $table->string('id_commande_fourni')->index();
            $table->unsignedBigInteger('quantite_cmd');
            $table->double('prix_total');
            $table->foreign('id_commande_fourni')
            ->references('reference_commande')->on('commande_fournisseurs')
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
        Schema::dropIfExists('fournisseurs');
        Schema::dropIfExists('commande_fournisseurs');
        Schema::dropIfExists('lignecommandes');
    }
}
