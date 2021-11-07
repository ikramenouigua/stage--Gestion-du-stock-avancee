<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->date('date_devis');
            $table->unsignedInteger('id_client')->index();
            $table->foreign('id_client')
            ->references('id')->on('clients')
            ->onDelete('cascade');
            $table->string('numero_commande')->index();
            $table->foreign('numero_commande')
            ->references('reference_commande')->on('commande_clients')
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
        Schema::dropIfExists('devies');
    }
}
