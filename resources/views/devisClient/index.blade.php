@extends('layouts.master')
@section('content')
<br/><br/><br/><br/>
    
    <table class="table table-bordered" id="table">
        <tr>
            <th>Identifiant</th>
            <th>Client</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($commande_clients as $commande_client)
        <tr>
        <td style="width: 100px;">D{{ $commande_client->id }}</td>
        <td style="width: 250px;">{{ \App\Models\Client::find($commande_client->id_client)->nom }}</td>
        
            <td>
              
            <a class="btn btn-primary" href="{{ route('commandec.devipdf',$commande_client->reference_commande) }}"><i class="fas fa-file-pdf"></i></button>
                   
            </td>
        </tr>
        @endforeach
    </table>
    @endsection