<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livraison;

class LivraisonController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:liste livraison|creer livraison|modifier livraison|supprimer livraison', ['only' => ['index','store']]);
        $this->middleware('permission:creer livraison', ['only' => ['create','store']]);
        $this->middleware('permission:modifier livraison', ['only' => ['edit','update']]);
        $this->middleware('permission:supprimer livraison', ['only' => ['destroy']]);
        
    }

    public function index(){
        $livraisons = Livraison::latest()->paginate(1000);
        $notifications = auth()->user()->unreadNotifications->count();
    
        return view('livraison.index',compact('livraisons'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('notif',$notifications);
      
    }
   
    public function store(Request $request){
        $request->validate([
            
            'ville'=> 'required',
            'prix'=> 'required',

        ]);
        $livraison = new Livraison();
        $livraison->ville=$request->ville;
        $livraison->prix=$request->prix;
        $livraison->save();
        return redirect()->route('livraison.index')
                        ->with('success','livraison created successfully.');
    }
    public function edit(Livraison $livraison)
    {
         return view('livraison.edit',compact('livraison'));
    }

    public function update(Request $request, $id)
    {
        $livraison = Livraison::findOrFail($id);
        $livraison->ville = $request->ville;
        $livraison->prix=$request->prix;
        $livraison->save();
        return redirect()->route('livraison.index')
        ->with('success','livraison updated successfully');
    }
     function destroy(Livraison $livraison)
    {

        $livraison->delete();
        return redirect()->route('livraison.index')
                        ->with('success','livraison deleted successfully');
    }
}
