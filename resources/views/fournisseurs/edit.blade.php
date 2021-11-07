@extends('fournisseurs.layout')
@section('content')
   <body class="b">
<form action="{{ route('fournisseur.update',$fournisseur->id) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="main-container">
     <h2 id="titre">Fournisseurs </h2>
     <br/>
     <div class="col-xs-12 col-sm-12 col-md-12">
          
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom :</strong>
                <input id="input-b" type="text" name="nom_fournisseur" class="form-control" value="{{$fournisseur->nom_fournisseur}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email :</strong>
                <input id="input-b" type="text" name="email" class="form-control" value="{{$fournisseur->email}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone :</strong>
                <input id="input-b" type="text" name="tel" class="form-control" value="{{$fournisseur->tel}}">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn">Confirmer les modifications Modifier</button>
        </div>
    </div>
   
</form>
  <br/><br/>
     <div class="row">
         <div class="col-lg-12 margin-tb">
             
                                  
         </div>
     </div>
   </body>
@endsection