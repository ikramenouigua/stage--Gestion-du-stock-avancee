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
    <h2 class="titre_cat">Les parametres de livraisons </h2>
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
   
<form action="{{ route('livraison.store') }}" method="POST"  >
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom de la ville:</strong>
                <input type="text" name="ville" class="form-control" placeholder="nom de la ville">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix: </strong>
                <input type="number" name="prix" class="form-control" placeholder="sa prix de livraison">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @can('creer livraison')
                  
                <button type="submit"id="btn-color" class="btn btn-primary">Ajouter une taxe</button>
        @endcan
        </div>
    </div>
   
</form>
    <br/><br/>
    
     <table class="table table-bordered" id="table">
         <tr>
             <th>Identifiant</th>
             <th>Nom du taxe</th>
             <th width="100px">Valeur</th>
         </tr>
         @foreach ($livraisons as $livraison)
         <tr>
         <td style="width: 100px;">{{ $livraison->id }}</td>
         <td style="width: 150px;">{{ $livraison->ville }}</td>
         <td style="width: 100px;">{{ $livraison->prix }}</td>
         <td style="width: 50px;">
         <form action="{{ route('livraison.destroy',$livraison) }}" method="POST">
         @can('modifier livraison')
        <a class="btn btn-primary" href="{{ route('livraison.edit',$livraison->id) }}"><i class="fas fa-edit"></i></a>
        @endcan

   
        @can('supprimer livraison')
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