
@extends('layouts.master') 
 @section('content')

<body class="back-fourni">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
           
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
   
<form action="{{ route('fournisseur.store') }}" method="POST">
    @csrf
  
     <div class="main-container">
     <h2 style="color:#0DB1B9;margin-top:0px;">Fournisseurs </h2>
     <br/>
     <div class="col-xs-12 col-sm-12 col-md-12">
          
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom :</strong>
                <input type="text" name="nom_fournisseur" class="form-control" placeholder="Nom complet....">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email :</strong>
                <input type="text" name="email" class="form-control" placeholder="email........">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone :</strong>
                <input type="text" name="tel" class="form-control" placeholder="Téléphone.........">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @can('ajouter fournisseur')
                <button type="submit" class="btn btn-primary" id="btn">Ajouter un noveau fournisseur</button>
        @endcan
        </div>
    </div>
   
</form>
  <br/><br/>
     <div class="row">
         <div class="col-lg-12 margin-tb">
             
                                  
         </div>
     </div>
   
    
     <table class="table table-bordered" id="table">
         <tr>
             <th>Identifiant</th>
             <th>Nom fournisseur</th>
             <th>Email</th>
             <th width="280px">Action</th>
         </tr>
         @foreach ($fournisseurs as $fournisseur)
         <tr>
             <td>{{ $fournisseur->id }}</td>
             <td>{{ $fournisseur->nom_fournisseur }}</td>
             <td>{{ $fournisseur->email }}</td>
             <td>
                 <form action="{{ route('fournisseur.destroy',$fournisseur->id) }}" method="POST">
    
                     <a class="btn btn-info" href="{{ route('fournisseur.show',$fournisseur->id) }}" target="iframe1">Show</a>
                     @can('modifier fournisseur')
                     <a class="btn btn-primary" href="{{ route('fournisseur.edit',$fournisseur->id) }}">Edit</a>
                     @endcan
    
                     @csrf
                     @method('DELETE')
                     @can('supprimer fournisseur')
                     <button type="submit" class="btn btn-danger">Delete</button>
                     @endcan
                 </form>
             </td>
         </tr>
         @endforeach
     </table>
     <div style="margin-left:600px;">
     <iframe name="iframe1" src="target.html" allowtransparency = "true" style="width:450px;height:450px; background : transparent; text-align: center;
     border-radius:50px; "></iframe>
</div>
   </body>
       
 @endsection