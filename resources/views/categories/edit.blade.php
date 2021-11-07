@extends('categories.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 id="titre-edit">Modifier la catégorie</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}" id="ack-btn"> <img src="/images/back.png"></a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $category->id }}" class="form-control" placeholder="libbélé" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom du catégorie:</strong>
                    <input type="text" name="nom_cat" value="{{ $category->nom_cat }}" class="form-control" placeholder="nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description :</strong>
                    <textarea name="description" cols="5"rows="5" class="form-control">{{$category->description}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Imagevv :</strong>
                    <input type="file" name="image_cat" value="c:/amrit.txt" class="form-control">
                </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" id="confirm-btn">Confirmer les modifications</button>
            </div>
        </div>
   
    </form>
@endsection
