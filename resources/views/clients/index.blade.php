@extends('layouts.master')
@section('content')
<!doctype html>
<html lang="en">
  <head>
  

	</head>
    <body>
    <div class="main-container">
    <h1 class="titre-client">Les clients </h1>
    <table  class="table table-bordered" id="table-client">
        <div style="margin-left:200px;">
           
            <br/><br></br/> <br/>
        </div>
        <tr>
            <th width="100px">Identifiant</th>
            <th width="100px">Nom</th>
            <th width="100px">Prénom</th>
            <th width="150px">Email</th>
            <th width="150px">Téléphone 1</th>
            <th width="150px">Téléphone 2</th>
            <th width="190px">Adresse 1</th>
            <th width="190px">Adresse 2</th>
            <th width="190px">groupe</th>


            <th width="600px">Action</th>
        </tr>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->nom}}</td>
            <td>{{$client->prenom}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->tel1}}</td>
            <td>{{$client->tel2}}</td>
            <td>{{$client->address1}}</td>
            <td>{{$client->addresse2}}</td>
            <td>{{ \App\Models\groupClient::find($client->id_group_client)->nom }}</td>
            
            <td>
                 <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
    
                 @can('modifier clients')
                     <a class="btn btn-info" href="{{ route('clients.edit',$client->id) }}"><i class="fas fa-edit"></i></a>
                @endcan
    
                     @csrf
                     @method('DELETE')
                     @can('supprimer clients')
                     <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                     @endcan
                 </form>
             </td>
            </td>
        </tr>
    @endforeach
    </table>

    </div>
	</body>
</html>



@endsection