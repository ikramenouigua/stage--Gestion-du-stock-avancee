<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-liste', 'avoireFournisseur-Create',
           'role-create',  'avoiresFournisseur-liste',
           'role-edit',    'avoiresClient-create',
           'role-delete',   'avoiresClient-liste',
           'product-list',  'bondeLivraison-show',
           'product-create',  'bondeLivraison-create',
           'product-edit',     'bondeLivraison-listeBL',
           'product-delete',     'caracteristique-create',
           'commandeF-listeBC',   'caracteristique-edit',
           'commandeF-create',     'caracteristique-delete',
           'commandeF-edit',        'caracteristique-liste',
           'commandeF-delete',      'categories-liste',
           'commandeF-createPDF',     'categories-create',
           'commandeC-listeBC',        'categories-edit',
           'commandeC-create',      'categories-delete',
           'commandeC-edit',      'entreprise-create',
           'commandeC-delete',    'fournisseur-create',
           'commandeC-createPDF',    'fournisseur-edit',
           'commandeC-facturepdf',    'fournisseur-delete',
           'commandeC-devipdf',        'fournisseur-liste',
           'stocke-liste',  'setting', 'bondeLivraison-bondepdf',
           'clients-create',  'clients-liste',
           'clients-edit', 'clients-delete',

        ];
     
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}