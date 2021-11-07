<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            $table->unique(['name', 'guard_name']);
           
        });
      

        DB::table('permissions')->insert(
            array(
               [ 'name' => 'ajouter categories',    'guard_name'=>'web' ],
                [ 'name' => 'modifier categories',   'guard_name'=>'web' ],
                [ 'name' => 'supprimer categories',    'guard_name'=>'web' ],
                [ 'name' => 'liste categories',    'guard_name'=>'web' ],

                [ 'name' => 'ajouter produits',   'guard_name'=>'web' ],
                [ 'name' => 'modifier produits',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer produits',    'guard_name'=>'web' ],
                [ 'name' => 'liste produits',   'guard_name'=>'web' ],

                [ 'name' => 'ajouter caracteristique',   'guard_name'=>'web' ],
                [ 'name' => 'modifier caracteristique',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer caracteristique',    'guard_name'=>'web' ],
                [ 'name' => 'liste caracteristique',   'guard_name'=>'web' ],

                [ 'name' => 'ajouter clients',   'guard_name'=>'web' ],
                [ 'name' => 'modifier clients',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer clients',    'guard_name'=>'web' ],
                [ 'name' => 'liste clients',   'guard_name'=>'web' ],

                [ 'name' => 'creer avoiresClient',    'guard_name'=>'web' ],
                [ 'name' => 'liste avoiresClient',   'guard_name'=>'web' ],

                [ 'name' => 'creer avoireFournisseur',    'guard_name'=>'web' ],
                [ 'name' => 'liste avoireFournisseur',   'guard_name'=>'web' ],

                [ 'name' => 'creer bondeLivraison',   'guard_name'=>'web' ],
                [ 'name' => 'afficher bondeLivraison',    'guard_name'=>'web' ],
                [ 'name' => 'avoiresClient-listeBL',    'guard_name'=>'web' ],
                [ 'name' => 'avoiresClient-bondepdf',   'guard_name'=>'web' ],

                [ 'name' => 'listeBC commandeC',   'guard_name'=>'web' ],
                [ 'name' => 'creer commandeC',    'guard_name'=>'web' ],
                [ 'name' => 'modifier commandeC',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer commandeC',   'guard_name'=>'web' ],
                [ 'name' => 'creerPDF commandeC',    'guard_name'=>'web' ],
                [ 'name' => 'facturePDF commandeC',    'guard_name'=>'web' ],
                [ 'name' => 'devisPDF commandeC',   'guard_name'=>'web' ],
               

                [ 'name' => 'listeBC commandeF',   'guard_name'=>'web' ],
                [ 'name' => 'creer commandeF',    'guard_name'=>'web' ],
                [ 'name' => 'modifier commandeF',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer commandeF',   'guard_name'=>'web' ],
                [ 'name' => 'creerPDF commandeF',    'guard_name'=>'web' ],

                [ 'name' => 'ajouter fournisseur',   'guard_name'=>'web' ],
                [ 'name' => 'modifier fournisseur',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer fournisseur',    'guard_name'=>'web' ],
                [ 'name' => 'liste fournisseurs',   'guard_name'=>'web' ],

                [ 'name' => 'creer role',   'guard_name'=>'web' ],
                [ 'name' => 'modifier role',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer role',    'guard_name'=>'web' ],
               
                [ 'name' => 'liste stock',    'guard_name'=>'web' ],

                [ 'name' => 'creer taxe',   'guard_name'=>'web' ],
                [ 'name' => 'modifier taxe',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer taxe',    'guard_name'=>'web' ],

                [ 'name' => 'creer livraison',   'guard_name'=>'web' ],
                [ 'name' => 'modifier livraison',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer livraison',    'guard_name'=>'web' ],
               
                [ 'name' => 'creer type_paiement',   'guard_name'=>'web' ],
                [ 'name' => 'modifier type_paiement',    'guard_name'=>'web' ],
                [ 'name' => 'supprimer type_paiement',    'guard_name'=>'web' ],

                [ 'name' => 'creer entreprise',   'guard_name'=>'web' ],
                [ 'name' => 'modifier entreprise',   'guard_name'=>'web' ],

                [ 'name' => 'statistique',   'guard_name'=>'web' ],
                [ 'name' => 'rapport vente',    'guard_name'=>'web' ],
                [ 'name' => 'rapport achat',    'guard_name'=>'web' ],
                [ 'name' => 'rapport client',   'guard_name'=>'web' ],
                [ 'name' => 'affiche ventes',   'guard_name'=>'web' ],
                [ 'name' => 'affiche achats',   'guard_name'=>'web' ],
                [ 'name' => 'affiche clients',   'guard_name'=>'web' ],
                [ 'name' => 'affiche factures',   'guard_name'=>'web' ],
               
          

            )
        );
        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });
        DB::table('roles')->insert(
            array(
               [ 'name' => 'administrateur',    'guard_name'=>'web' ],
               

            )
        );
        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });
        
        DB::table('role_has_permissions')->insert(
            array(
               [ 'permission_id' => 1,    'role_id'=>1 ], [ 'permission_id' => 2,    'role_id'=>1 ],
               [ 'permission_id' => 3,    'role_id'=>1 ], [ 'permission_id' => 4,    'role_id'=>1 ],
               [ 'permission_id' => 5,    'role_id'=>1 ], [ 'permission_id' => 6,    'role_id'=>1 ],
               [ 'permission_id' => 7,    'role_id'=>1 ], [ 'permission_id' => 8,    'role_id'=>1 ],
               [ 'permission_id' => 9,    'role_id'=>1 ], [ 'permission_id' => 10,    'role_id'=>1 ],
               [ 'permission_id' => 11,    'role_id'=>1 ], [ 'permission_id' => 12,    'role_id'=>1 ],
               [ 'permission_id' => 13,    'role_id'=>1 ], [ 'permission_id' => 14,    'role_id'=>1 ],
               [ 'permission_id' => 15,    'role_id'=>1 ], [ 'permission_id' => 16,    'role_id'=>1 ],
               [ 'permission_id' => 17,    'role_id'=>1 ], [ 'permission_id' => 18,    'role_id'=>1 ],
               [ 'permission_id' => 19,    'role_id'=>1 ], [ 'permission_id' => 20,    'role_id'=>1 ],
               [ 'permission_id' => 21,    'role_id'=>1 ], [ 'permission_id' =>22,    'role_id'=>1 ],
               [ 'permission_id' => 23,    'role_id'=>1 ], [ 'permission_id' => 24,    'role_id'=>1 ],
               [ 'permission_id' => 25,    'role_id'=>1 ], [ 'permission_id' => 26,    'role_id'=>1 ],
               [ 'permission_id' => 27,    'role_id'=>1 ], [ 'permission_id' => 28,    'role_id'=>1 ],
               [ 'permission_id' => 29,    'role_id'=>1 ], [ 'permission_id' => 30,    'role_id'=>1 ],
               [ 'permission_id' => 31,    'role_id'=>1 ], [ 'permission_id' => 32,    'role_id'=>1 ],
               [ 'permission_id' => 33,    'role_id'=>1 ], [ 'permission_id' => 34,    'role_id'=>1 ],
               [ 'permission_id' => 35,    'role_id'=>1 ], [ 'permission_id' => 36,    'role_id'=>1 ],
               [ 'permission_id' => 37,    'role_id'=>1 ], [ 'permission_id' => 38,    'role_id'=>1 ],
               [ 'permission_id' => 39,    'role_id'=>1 ], [ 'permission_id' => 40,    'role_id'=>1 ],
               [ 'permission_id' => 41,    'role_id'=>1 ], [ 'permission_id' => 42,    'role_id'=>1 ],
               [ 'permission_id' => 43,    'role_id'=>1 ], [ 'permission_id' => 44,    'role_id'=>1 ],
               [ 'permission_id' => 45,    'role_id'=>1 ], [ 'permission_id' => 46,    'role_id'=>1 ],
               [ 'permission_id' => 47,    'role_id'=>1 ], [ 'permission_id' => 48,    'role_id'=>1 ],
               [ 'permission_id' => 49,    'role_id'=>1 ], [ 'permission_id' => 50,    'role_id'=>1 ],
               [ 'permission_id' => 51,    'role_id'=>1 ], [ 'permission_id' => 52,    'role_id'=>1 ],
               [ 'permission_id' => 53,    'role_id'=>1 ], [ 'permission_id' => 54,    'role_id'=>1 ],
               [ 'permission_id' => 55,    'role_id'=>1 ],[ 'permission_id' => 56,    'role_id'=>1 ],
               [ 'permission_id' => 57,    'role_id'=>1 ], [ 'permission_id' => 58,    'role_id'=>1 ],
               [ 'permission_id' => 59,    'role_id'=>1 ], [ 'permission_id' => 60,    'role_id'=>1 ],
               [ 'permission_id' => 61,    'role_id'=>1 ],[ 'permission_id' => 62,    'role_id'=>1 ],
               [ 'permission_id' => 63,    'role_id'=>1 ]
              
              
            )
        );
    
        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
