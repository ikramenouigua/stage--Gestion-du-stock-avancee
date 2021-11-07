<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    //
    function __construct()
    {
       
    } 
  

    public function index(){
        $notifications = auth()->user()->unreadNotifications->count();
       return view('permission.index')
       ->with('notif',$notifications);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $permission = Permission::create(['name' => $request->input('name')]);
        
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
}
