<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stockes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockes', function (Blueprint $table) {
            $table->id();
            $table->date('date_entree');
            $table->date('date_sortie');
            $table->unsignedInteger('Référence_produit');
            $table->Integer('stocke_initial');
            $table->Integer('entree');
            $table->Integer('sortie');
            $table->string('ref_cmd');
            $table->Integer('new_stocke');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stockes');
    }
}
