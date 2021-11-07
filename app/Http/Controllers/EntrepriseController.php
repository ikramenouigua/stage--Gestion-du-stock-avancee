<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;

class EntrepriseController extends Controller
{

  function __construct()
    {
      $this->middleware('permission:liste entreprise|creer entreprise|modifier entreprise', ['only' => ['store']]);
         $this->middleware('permission:creer entreprise', ['only' => ['store']]);
         $this->middleware('permission:modifier entreprise', ['only' => ['edit','update']]);
       
        
    }

    public function index(){
      $notifications = auth()->user()->unreadNotifications->count();
      if($entreprise=Entreprise::find(1)){
        return view('entreprises.home',compact('entreprise'))
        ->with('notif',$notifications);
      }else{
        return view('entreprises.index')
        ->with('notif',$notifications);
      }
       
    }
    public function show(Entreprise $entreprise){
      
      $entreprise=Entreprise::findOrFail(1);
     
    }
    public function store(Request $request){

      $request->validate([
            
        'nom'=> 'required',
        'date_creation'=> 'required',
        'raison_sociale'=> 'required',
        'adresse'=> 'required',
        'tele'=> 'required',
        'site_web'=> 'required',
        'ICE'=> 'required',
        'RC'=> 'required',
        'IF'=> 'required',
        'CNSS'=> 'required',
        'logo'=> 'required',
        'description'=> 'required',

    ]);
    $entreprise= new Entreprise();
    $entreprise->nom=$request->nom;
    $entreprise->raison_sociale=$request->raison_sociale;
    $entreprise->adresse=$request->adresse;
    $entreprise->tele=$request->tele;
    $entreprise->site_web=$request->site_web;
    $entreprise->ICE=$request->ICE;
    $entreprise->RC=$request->RC;
    $entreprise->IF=$request->IF;
    $entreprise->CNSS=$request->CNSS;
    $entreprise->description=$request->description;
    $entreprise->date_creation=$request->date_creation;
    if ($request->hasFile('logo')) {
      $filename = $request->logo->getClientOriginalName();
      $request->logo->storeAs('images/entreprise', $filename, 'public');
      $entreprise->logo = $filename;
    }
    $entreprise->save();
      return redirect()->back()->with('message', 'Entreprise created successfully!' );

    }
    public function edit(Entreprise $entreprise)
    {
      $notifications = auth()->user()->unreadNotifications->count();
         return view('entreprises.edit',compact('entreprise'))
         ->with('notif',$notifications);
    }

    public function update(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->nom=$request->nom;
        $entreprise->raison_sociale=$request->raison_sociale;
        $entreprise->adresse=$request->adresse;
        $entreprise->tele=$request->tele;
        $entreprise->site_web=$request->site_web;
        $entreprise->ICE=$request->ICE;
        $entreprise->RC=$request->RC;
        $entreprise->IF=$request->IF;
        $entreprise->CNSS=$request->CNSS;
        $entreprise->description=$request->description;
        $entreprise->date_creation=$request->date_creation;
        if ($request->hasFile('logo')) {
          $filename = $request->logo->getClientOriginalName();
          $request->logo->storeAs('images/entreprise', $filename, 'public');
          $entreprise->logo = $filename;
        }
        $entreprise->save();
        return redirect()->route('entreprise.index')
        ->with('success','entreprise updated successfully');
    }
    public function destroy(){

    }
}
