<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\groupClient;
use DB;

class ClientController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:liste clients|ajouter clients|modifier clients|supprimer clients', ['only' => ['liste']]);
         $this->middleware('permission:ajouter clients', ['only' => ['index','store']]);
         $this->middleware('permission:modifier clients', ['only' => ['edit','update']]);
         $this->middleware('permission:supprimer clients', ['only' => ['destroy']]);
         $this->middleware('permission:liste clients', ['only' => ['liste']]);
       
    }
        public function index(){
        $clients = Client::latest()->paginate(5);
        $groups=groupClient::get();
        $notifications = auth()->user()->unreadNotifications->count();
        return view('clients.create',compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('groups',$groups)
            ->with('notif',$notifications);
            
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom',
            'prenom',
            'email',
            'tel1',
            'tel2',
            'address1',
            'addresse2',
        ]);
          $nom = $request->get('nom');
          $prenom = $request->get('prenom');
          $email = $request->get('email');
          $tel1 = $request->get('tel1');
          $tel2 = $request->get('tel2');
          $adr1 = $request->get('address1');
          $adr2 = $request->get('addresse2');
          $group=$request->get('group');
          

       $client = new Client(); 
       $client->nom = $nom;
       $client->prenom = $prenom;
       $client->email = $email;
       $client->tel1 = $tel1;
       $client->tel2 = $tel2;
       $client->address1 = $adr1;
       $client->addresse2= $adr2;
       $client->id_group_client= $group;
       $client->save();
       $clients = Client::get();
       $notifications = auth()->user()->unreadNotifications->count();
        return view('clients.index')
                       ->with('clients',$clients)
                       ->with('notif',$notifications)
                        ->with('success','Caracteristique created successfully.');
    }

    public function edit(Client $client)
    {
        $groups=groupClient::get();
        $notifications = auth()->user()->unreadNotifications->count();
        return \View::make('clients.edit', [
             'client' => $client,'groups' => $groups]);
         //return view('products.edit',compact('product'));
    }
    public function liste(){
        $notifications = auth()->user()->unreadNotifications->count();
        $clients = Client::get();
        return \View::make('clients.index')
        ->with('clients',$clients)
        ->with('notif',$notifications);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom',
            'prenom',
            'email',
            'tel1',
            'tel2',
            'address1',
            'addresse2',
        ]);
    
        $client->update($request->all());
        $clients = Client::get();
        $notifications = auth()->user()->unreadNotifications->count();
        return redirect()->route('clients.liste')
                       ->with('clients',$clients)
                        ->with('success','Fournisseur updated successfully')
                        ->with('notif',$notifications);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $notifications = auth()->user()->unreadNotifications->count();
        $clients = Client::get();
        return redirect()->route('clients.liste')
                       ->with('clients',$clients)
                        ->with('success','client deleted successfully')
                        ->with('notif',$notifications);
    }
}
