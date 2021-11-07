@extends('caracteristiques.layout')

 
@section('content')
<body style="background-color:white;">
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
   
<form action="{{ route('caracteristiques.update',$caracter) }}" method="POST">
    @csrf
     <div class="main-container">
     <h1 style="color:blue;">Les Caractéristiques</h1>
     <br/>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Référence:</strong>
                <select name="ref_produit" class="form-control">
                @foreach($caracteristiques as $c)
                <option value="{{$c->reference}}" selected>{{$c->reference}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Couleur:</strong>
                <input type="text" name="couleur" class="form-control" value="{{$c->couleur}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Taille:</strong>
                <input type="text" name="taille" class="form-control" value="{{$c->taille}}">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
   
</form>

<br/><br/>
   
                  
  
      </body>
@endsection