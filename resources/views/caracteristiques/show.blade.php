@extends('categories.Layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br/><br/>
                <h2> Des informations</h2>
            </div>
            <br/><br/>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('caracteristiques.index') }}"> Retour</a>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              @foreach($caracter as $c)
                <strong>Référence du produit:</strong>
                {{ $c->id }}
            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Couleur:</strong>
                {{ $c->couleur }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Taille:</strong>
                {{ $c->taille }}
            </div>
        </div>
        @endforeach
    
        </div>
    
@endsection