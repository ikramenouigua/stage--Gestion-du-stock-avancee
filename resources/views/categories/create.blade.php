@extends('products.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter une catégorie </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
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
   
<form action="{{ route('categories.store') }}" method="POST"  enctype="multipart/form-data">
    @csrf
  
     <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Identifiant:</strong>
                <input type="text" name="id" class="form-control" placeholder="identifiant">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom fhwehhef3hb du catégorie:</strong>
                <input type="text" name="nom_cat" class="form-control" placeholder="Référence">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Image</label>
  <input type="file" class="form-control" id="formGroupExampleInput2" name="image_url" >
</div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ajouter une catégorie</button>
        </div>
    </div>
   
</form>
@endsection