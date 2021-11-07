<?php
  
namespace App\Http\Controllers;
   
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:liste categories|ajouter categories|supprimer categories|liste categories', ['only' => ['index','show']]);
        $this->middleware('permission:ajouter categories', ['only' => ['index','store']]);
        $this->middleware('permission:modifier categories', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer categories', ['only' => ['destroy']]);
        $this->middleware('permission:liste categories', ['only' => ['show']]);
      
    }

    public function index()
    {
        $categories = Categorie::latest()->paginate(1000);
        $notifications = auth()->user()->unreadNotifications->count();
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifications = auth()->user()->unreadNotifications->count();
        return view('categories.index')
        ->with('notif',$notifications);
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
            
            'nom_cat'=> 'required',
            'image_url'=> 'required',
            'description',

        ]);
        $category = new Categorie();
        
        if ($request->hasFile('image_url')) {
            $filename = $request->image_url->getClientOriginalName();
            $request->image_url->storeAs('images/categories', $filename, 'public');
            $category->image_cat = $filename;
        }
        $category->nom_cat=$request->nom_cat;
        $category->description=$request->description;
        $category->save();
        return redirect()->route('categories.index')
                        ->with('success','Category created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        return view('categories.show',compact('category'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $category)
    {
       
         return view('categories.edit',compact('category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $category)
    {
        $request->validate([

            'id'=> 'required',
            'nom_cat'=> 'required',
            'image_cat'=> 'string',
            
        ]);
    
        $category->update($request->all());
    
        return redirect()->route('categories.index')
                        ->with('success','Category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        $category->delete();
    
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }
}
