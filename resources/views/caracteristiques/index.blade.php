@extends('layouts.master')

 
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
   
<form action="{{ route('caracteristiques.store') }}" method="POST">
    @csrf
     <div class="main-container">
     <h1 style="color:#0DB1B9;">Les Caractéristiques</h1>
     <br/>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Référence:</strong>
                <select name="ref_produit" class="form-control">
                @foreach($products as $p)
                <option>{{$p->ref_produit}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Couleur:</strong>
                <input type="text" name="couleur" class="form-control" placeholder="couleur">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Taille:</strong>
                <input type="text" name="taille" class="form-control" placeholder="taille">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn">Enregistrer</button>
        </div>
    </div>
   
</form>

<br/><br/>
    <table class="table table-bordered">
        <tr>
            <th>Référence</th>
            <th>Libéllé du produit</th>
            <th>Quantité</th>
            <th width="350px">Action</th>
        </tr>
        @foreach($caracteristiques as $c)
						    <tr class="alert" role="alert">
						    <td>{{$c->reference}}</td>
                            <td>{{$c->couleur}}</td>
                            <td>{{$c->taille}}</td>
                            <td>
                <form action="{{ route('caracteristiques.destroy',$c->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('caracteristiques.show',$c->id) }}"><i class="fas fa-eye"></i></a>
                    @can('modifier caracteristique')
                    <a class="btn btn-primary" href="{{ route('caracteristiques.edit',$c) }}"><i class="fas fa-edit"></i></a>
                    @endcan
   
                    @csrf
                    @method('DELETE')
                    @can('supprimer caracteristique')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    @endcan
                </form>
            </td>
							@endforeach
    </table>
  
      </body>
@endsection