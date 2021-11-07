<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SettingController extends Controller
{


    function __construct()
    {
        
        
    }
    
     public function index(){
        $notifications = auth()->user()->unreadNotifications->count();
         return view('setting.commande')
         ->with('notif',$notifications);
     }

     public function store(Request $request){
         $prefix = $request->get('prefix');
         $order = $request->get('order');
         $order2 = $request->get('order2');

    $update = DB::table('settings')
    ->update(['prefix' => $prefix, 'order'=>$order, 'order2'=>$order2]); 

    return redirect()->back()->with('message', 'setting updated successfully!' );
     }

     public function mode_payement(){
        $notifications = auth()->user()->unreadNotifications->count();
         return view('setting.payement')
         ->with('notif',$notifications);
     }
}
