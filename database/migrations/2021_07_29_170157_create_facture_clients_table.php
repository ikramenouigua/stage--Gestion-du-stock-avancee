<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_clients', function (Blueprint $table) {
            $table->id();
            $table->string('id_commande_client')->index();
            $table->foreign('id_commande_client')
            ->references('reference_commande')->on('commande_clients')
            ->onDelete('cascade');
            $table->unsignedInteger('id_client')->index()->increments();
            $table->foreign('id_client')
            ->references('id')->on('clients')
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
        Schema::dropIfExists('facture_clients');
    }
}
