<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesCategoriesETproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nom_cat')->unique();
            $table->string('description');
            $table->binary('image_cat');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ref_produit');
            $table->string('libelle_produit', 512)->index();
            $table->string('unite_produit', 10);
            $table->integer('quantite');
            $table->string('description');
            $table->Integer('stocke_min');
            $table->decimal('prix_achat')->default(0);
            $table->decimal('prix_vente')->default(0);
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')
            ->references('id')->on('categories')
            ->onDelete('cascade');
            $table->string('image_produit');
            $table->timestamps();
        });
        Schema::create('caracteristiques', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('couleur');
            $table->string('taille');
            $table->unsignedBigInteger('ref_produit');
            $table->foreign('ref_produit')
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('caracteristiques');
    }
}
