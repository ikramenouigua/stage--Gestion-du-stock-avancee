<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\Client;
use App\Notifications\NewUserNotification;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\AssignRole;
use Illuminate\Support\Arr;
class CustomAuthController extends Controller
{

    public function index()
    {
        
        return view('auth.login');
    }  
      
    

    
    public function notif()
    {

       
        $notifications = auth()->user()->unreadNotifications;
        $notif = auth()->user()->unreadNotifications->count();

        return view('accueil.notif', compact('notifications'))
        ->with('notif',$notif);
    }

    public function markNotification($id)
{
   
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect()->route('notif');
        }
}
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required', 
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
            ->withSuccess('Signed in');
        }
  
        return redirect("login")
        ->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        $roles=Role::get();
        return view('auth.registration',compact('roles'));
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type'=>'required',
        ]);
        $data = $request->all();
        $user=$this->create($data);
        return redirect("dashboard");
    }


    public function create(array $data)
    {
       
      $user = new User();
      $user->name = $data['name'];
      $user->password = Hash::make($data['password']);
      $user->email = $data['email'];
      $user->type=$data['type'];
      $user->assignRole($data['type']);
      return $user->save();
      

    }   
    

    public function dashboard()
    {
        $categories = DB::table('categories')->count();
        $products =   DB::table('products')->count();
        $fournisseurs = DB::table('fournisseurs')->count();
        $clients = DB::table('clients')->count();

        if(Auth::check()){
            return view('dashboard') 
            ->with('categories',$categories)
            ->with('products',$products)
            ->with('fournisseurs',$fournisseurs)
            ->with('clients',$clients);
        }
        return redirect("login")
        ->withSuccess('You are not allowed to access');
    }
    public function profile(){
        $notifications = auth()->user()->unreadNotifications->count();   
        $user_id = Auth::id();
        $user=User::findOrFail( $user_id);

      return view('auth.profile',compact('user'))
      ->with('notif',$notifications);
    }
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}