@extends('layouts.master')


@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="main-container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestion des roles</h2>
        </div>
        <div class="pull-right">
        <br/><br/>
       
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Créer un noveau role</a>
           
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th>Permissions</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td> @foreach($role->getAllPermissions() as $permission)
           <label class="badge badge-success">{{ $permission->name }}</label>
        @endforeach
    </td>
        <td>
        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
   

   
   
    @csrf
    @method('DELETE')
    <button class="btn btn-warning" type="submit"><i class="fas fa-trash-alt"></i></button>
    
</form>
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}




</div>
@endsection