@extends('layouts.master')
 
 @section('content')
 <style>
 .btn1 {
  background-color: white; /* Blue background */
  border: none; /* Remove borders */
  color: blue; /* White text */
   /* Some padding */
  font-size: 20px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}
</style>
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
 <body style="background-color : white;">
 <div class="cont_div_cat">
    <div class="col-lg-12 margin-tb">
        <div>
</div>
        <div>
    <h2 class="titre_cat">Les types du paiement </h2>
</div>
        <div class="pull-left">
            <h2 class="titre_cat"> </h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Il y'a certain problems avec les données entrées<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('paiement.store') }}" method="POST"  >
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du paiement:</strong>
                <input type="text" name="valeur" class="form-control" placeholder="type du paiement">
            </div>
        </div>
        
       
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @can('creer type_paiement')
                <button type="submit"id="btn-color" class="btn btn-primary">Ajouter paiement</button>
        @endcan
        </div>
    </div>
   
</form>
    <br/><br/>
    
     <table class="table table-bordered" id="table">
         <tr>
             <th>Identifiant</th>
             <th>Nom paiement</th>
             
         </tr>
         @foreach ($paiements as $paiement)
         <tr>
         <td style="width: 100px;">{{ $paiement->id }}</td>
         <td style="width: 250px;">{{ $paiement->type }}</td>
         <td style="width: 50px;">
         <form action="{{ route('paiement.destroy',$paiement) }}" method="POST">
         @can('modifier type_paiement')
        <a class="btn btn-primary" href="{{ route('paiement.edit',$paiement->id) }}"><i class="fas fa-edit"></i></a>
        @endcan

   
        @can('supprimer type_paiement')
    @csrf
    @method('DELETE')
    <button class="btn btn-warning" type="submit"><i class="fas fa-trash-alt"></i></button>
    @endcan
</form>
            </td>
         </tr>
         @endforeach
     </table>
     
</body>
 @endsection