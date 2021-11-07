<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\CommandeFournisseurController;
use App\Http\Controllers\LigneCommandeController;
use App\Http\Controllers\FactureFournisseurController;
use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\CaracteristiqueController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeClientController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\BondeLivraisonController;
use App\Http\Controllers\StockeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AvoiresFController;
use App\Http\Controllers\AvoiresCController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaxeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('notification', [CustomAuthController::class, 'notif'])->name('notif');
//route redirecte vers page d'acceuil

Route::get('acceuil', [AcceuilController::class, 'index'])->name('acceuil'); 
     
 Route::get('rapport/vente', [AcceuilController::class, 'show_rapport'])->name('show_rapport'); 
Route::get('rapport/achat', [AcceuilController::class, 'show_rapport_achat'])->name('show_rapport_achat'); 
Route::get('rapport/client', [AcceuilController::class, 'show_rapport_client'])->name('show_rapport_client'); 
//Route redirecte vers dashboard
Route::get('dashboard', [AcceuilController::class, 'index']); 
//Route vere l'authentification
Route::get('stockex.com', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
//Route pour l'inscription
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
//Route pour déconnection 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Auth::routes();
//Route::resource('products', App\Http\Controllers\ProductsController::class);
//Route::resource('categories',App\Http\Controllers\CategoriesController::class);
//Route::resource('fournisseur',App\Http\Controllers\FournisseursController::class);
//Route::resource('commande',App\Http\Controllers\CommandeFournisseurController::class);
Route::resource('lignecommande',App\Http\Controllers\LigneCommandeController::class);
Route::resource('facturefournisseur',App\Http\Controllers\FactureFournisseurController::class);
Route::resource('factureclient',App\Http\Controllers\FactureClientController::class);
Route::get('liste',[App\Http\Controllers\CommandeFournisseurController::class, 'listeBC']);
Route::get('caractere',[App\Http\Controllers\ProductsController::class, 'caracteristique']);
Route::get('devipdf',[App\Http\Controllers\CommandeClientController::class,'createPDF',1])->name('commandec.createpdf');
Route::post('commande-liste',[App\Http\Controllers\CommandeFournisseurController::class, 'enregistrer'])->name('commande.enregistrer');
Route::get('/search', [CommandeFournisseurController::class, 'search'])->name('search');
Route::post('caractere',[App\Http\Controllers\ProductsController::class, 'store_caracteristique'])->name('products.caracteristique');
//Route::resource('caracteristiques',App\Http\Controllers\CaracteristiqueController::class);
//Route::resource('clients',App\Http\Controllers\ClientController::class);
Route::post('category',[App\Http\Controllers\CommandeFournisseurController::class,'category'])->name('commande.category');
//Route::resource('commandec',App\Http\Controllers\CommandeClientController::class);
Route::post('categoryc',[App\Http\Controllers\CommandeClientController::class,'categoryc'])->name('commandec.categoryc');
Route::post('mise-ajour',[App\Http\Controllers\CommandeFournisseurController::class, 'misajour'])->name('commande.misajour');
//Route::resource('entreprise',App\Http\Controllers\EntrepriseController::class);
Route::get('devipdf/{ref}',[App\Http\Controllers\CommandeClientController::class,'devipdf'])->name('commandec.devipdf');
Route::get('facturepdf/{ref}',[App\Http\Controllers\CommandeClientController::class,'facturepdf'])->name('commandec.facturepdf');
Route::get('facturepdf_F/{ref}',[App\Http\Controllers\CommandeFournisseurController::class,'facturepdf'])->name('commande.facturepdf');
Route::get('avoirepdf/{ref}',[App\Http\Controllers\AvoiresCController::class,'avoirepdf'])->name('avoirePDF');
Route::get('avoirepdf_F/{ref}',[App\Http\Controllers\AvoiresFController::class,'avoirepdf_F'])->name('avoirepdf_F');
//Route::resource('bondelivraison',App\Http\Controllers\BondeLivraisonController::class);
Route::get('listeBL',[App\Http\Controllers\BondeLivraisonController::class,'listeBL'])->name('bondelivraison.liste');
Route::get('bondepdf/{num}',[App\Http\Controllers\BondeLivraisonController::class,'bondepdf'])->name('bondelivraison.bondepdf');
Route::post('commandeclient-liste',[App\Http\Controllers\CommandeClientController::class, 'enregistrer'])->name('commandec.enregistrer');
Route::get('listeBCommande',[App\Http\Controllers\CommandeClientController::class, 'listeBC']);
Route::get('/rechercher', [CommandeClientController::class, 'rechercher'])->name('rechercher');
Route::resource('/stocke', App\Http\Controllers\StockeController::class);
Route::get('/chercher', [App\Http\Controllers\StockeController::class, 'rechercher']);
Route::get('liste-products',[App\Http\Controllers\ProductsController::class, 'liste']);
Route::get('liste-clients',[App\Http\Controllers\ClientController::class, 'liste'])->name('clients.liste');
Route::get('commandepdf/{ref}',[App\Http\Controllers\CommandeFournisseurController::class,'createPDF',1])->name('commande.createpdf');
Route::get('commandeclientpdf/{ref}',[App\Http\Controllers\CommandeClientController::class,'createPDF',1])->name('commandeclient.createpdf');
Route::resource('/setting', App\Http\Controllers\SettingController::class);
Route::post('categorybl',[App\Http\Controllers\BondeLivraisonController::class,'categorybl'])->name('commandec.categorybl');
//Route::resource('/avoiref', App\Http\Controllers\AvoiresFController::class);
Route::post('commandefourni',[App\Http\Controllers\AvoiresFController::class,'commande'])->name('commande.commandefourni');
Route::get('commandefourni',[App\Http\Controllers\AvoiresFController::class,'commande'])->name('commande.commandefourni');
//Route::resource('/avoirec', App\Http\Controllers\AvoiresCController::class);
Route::post('commandeclient',[App\Http\Controllers\AvoiresCController::class,'commande'])->name('commandec.commandeclient');
Route::get('commandeclient',[App\Http\Controllers\AvoiresCController::class,'commande'])->name('commandec.commandeclient');
Route::get('listef',[App\Http\Controllers\AvoiresFController::class,'liste'])->name('commande.liste');
Route::get('searchf',[App\Http\Controllers\AvoiresFController::class,'search'])->name('commande.search');
Route::get('listec',[App\Http\Controllers\AvoiresCController::class,'liste'])->name('commandec.liste');
Route::get('searchc',[App\Http\Controllers\AvoiresCController::class,'search'])->name('commandec.search');
Route::get('payement',[App\Http\Controllers\SettingController::class,'mode_payement'])->name('commandec.payement');
Route::get('profile', [CustomAuthController::class, 'profile'])->name('profile-user');
Route::get('vente', [AcceuilController::class, 'show_vente'])->name('show_vente');
Route::get('achat', [AcceuilController::class, 'show_achat'])->name('show_achat');
Route::get('show_clients', [AcceuilController::class, 'show_clients'])->name('show_clients');
Route::get('factures', [AcceuilController::class, 'show_facture'])->name('show_facture');
Route::post('changefacture', [App\Http\Controllers\FactureClientController::class, 'save'])->name('change_facture');
Route::get('devis', [App\Http\Controllers\devisClientController::class, 'show'])->name('devis');
Route::get('/mark-as-read/{id}', [CustomAuthController::class,'markNotification'])->name('markNotification');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('factureclient',App\Http\Controllers\FactureClientController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('products', App\Http\Controllers\ProductsController::class);
    Route::resource('commande',App\Http\Controllers\CommandeFournisseurController::class);
    Route::resource('commandec',App\Http\Controllers\CommandeClientController::class);
    Route::resource('categories',App\Http\Controllers\CategoriesController::class);
    Route::resource('fournisseur',App\Http\Controllers\FournisseursController::class);
    Route::resource('caracteristiques',App\Http\Controllers\CaracteristiqueController::class);
    Route::resource('clients',App\Http\Controllers\ClientController::class);
    Route::resource('bondelivraison',App\Http\Controllers\BondeLivraisonController::class);
    Route::resource('/avoiref', App\Http\Controllers\AvoiresFController::class);
    Route::resource('/avoirec', App\Http\Controllers\AvoiresCController::class);
    Route::resource('entreprise',App\Http\Controllers\EntrepriseController::class);
    Route::resource('taxe',App\Http\Controllers\TaxeController::class);
    Route::resource('livraison',App\Http\Controllers\LivraisonController::class);
    Route::resource('paiement',App\Http\Controllers\TypePaimentController::class);

});











