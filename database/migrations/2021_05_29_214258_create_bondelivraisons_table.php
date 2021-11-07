<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondelivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonde_livraisons', function (Blueprint $table) {
            $table->id();
            $table->date('date_bl');
            $table->string('etat_facture');
            $table->string('conditionnement');
            $table->integer('qte_commandee');
            $table->integer('qte_livree');
            $table->double('prix_total');
            $table->double('total_ttc');
            $table->double('total_tva');
            $table->string('mode_payement');
            $table->unsignedInteger('id_client')->index();
            $table->string('numero_commande')->index();
            $table->foreign('id_client')
            ->references('id')->on('clients')
            ->onDelete('cascade');
           
            $table->timestamps();
        });
        Schema::create('ligne_bonnde_livraisons', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('id_client')->index();
            $table->integer('qte');
            $table->double('prix_total');
            $table->double('total_ttc');
            $table->double('total_tva');
            $table->unsignedBigInteger('numero_livraison')->index();
            
           
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bondelivraisons');
        Schema::dropIfExists('ligne_bonnde_livraisons');
    }
}
