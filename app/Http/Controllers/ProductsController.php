<?php
  
namespace App\Http\Controllers;
   
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Caracteristique;
use Illuminate\Http\Request;
use DB;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:liste produits|ajouter produits|modifier produits|supprimer produits', ['only' => ['index','show']]);
        $this->middleware('permission:ajouter produits', ['only' => ['create','store']]);
        $this->middleware('permission:modifier produits', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer produits', ['only' => ['destroy']]);
    }

    public function index()
    {
        $products = Product::latest()->paginate(1000);
        $categories = Categorie::get();
        $notifications = auth()->user()->unreadNotifications->count();
       
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories',$categories)
            ->with('notif',$notifications);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        $categories = Categorie::get();
        return \View::make('products.index', [
            'categories' => $categories ,'notif'=> $notifications
        ]);
        //return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      
        $request->validate([
            'ref_produit' => 'required',
            'libelle_produit' => 'required',
            'unite_produit',
            'quantite',
            'stocke_min',
            'prix_achat',
            'prix_vente',
            'id_category',
            'image_produit',
            'description',

        ]);
        $product = new Product();
        
        if ($request->hasFile('image_produit')) {
            $filename = $request->image_produit->getClientOriginalName();
            $request->image_produit->storeAs('images/products', $filename, 'public');
            $product->image_produit= $filename;
        }
        $product->ref_produit=$request->ref_produit;
        $product->libelle_produit=$request->libelle_produit;
        $product->unite_produit=$request->unite_produit;
        $product->quantite=$request->quantite;
        $product->stocke_min=$request->stocke_min;
        $product->prix_achat=$request->prix_achat;
        $product->prix_vente=$request->prix_vente;
        $product->id_category=$request->id_category;
        $product->description=$request->description;
        $product->save(); 

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {  
        $color ="";$taille="";
        
            $id = $product->id;
        $caracteristique = DB::select('select * from caracteristiques where ref_produit = ?',[$id]);
       
    
        return view('products.show',compact('product'))
        ->with('caracteristique',$caracteristique);
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Categorie::get();
        return \View::make('products.edit', [
            'categories' => $categories, 'product' => $product
        ]);
         //return view('products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'id' => 'required',
            'libelle_produit' => 'required',
            'unite_produit',
            'quantite',
            'stocke_min',
            'prix_achat',
            'prix_vente',
            'id_category',
            'image_produit',
            'description',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function caracteristique(){
        $product = Product::get();
        return \View::make('products.caracteristique', [
            'product' => $product
        ]);
    }
    public function store_caracteristique(){
        $request->validate([
            
        ]);
    
        Product::create($request->all());
        return view('products.caracteristique')
                        ->with('success','Product created successfully.');
    }
    public function liste(){
        $products = Product::get();
        return view('products.liste')
        ->with('products',$products);
    }
}
