
@extends('layouts.master')
 
 @section('content')

 <body style="background-color : white;">
 <div class="cont_div_cat">
    <div class="col-lg-12 margin-tb">
        <div>
</div>
        <div>
    <h2 class="titre_cat">Les catégories </h2>
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
   
<form action="{{ route('categories.store') }}" method="POST"  enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du catégorie:</strong>
                <input type="text" name="nom_cat" class="form-control" placeholder="nom du catégorie">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" cols="3" rows="3"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Choisir une image: </strong>
                <input type="file" name="image_url" class="form-control" placeholder="Libellé">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit"id="btn-color" class="btn btn-primary">Ajouter une catégorie</button>
        </div>
    </div>
   
</form>
    <br/><br/>
    
     <table class="table table-bordered" id="table">
         <tr>
             <th>Identifiant</th>
             <th>Catégorie</th>
             <th width="280px">Action</th>
         </tr>
         @foreach ($categories as $category)
         <tr>
         <td style="width: 100px;">{{ $category->id }}</td>
         <td style="width: 250px;">{{ $category->nom_cat }}</td>
         
             <td>
                 <form action="{{ route('categories.destroy',$category) }}" method="POST">
    
                     <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}" target="iframe1">Afficher</a>
                     @can('modifier categories')
                     <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Modifier</a>
                     @endcan
    
                    
                     @can('supprimer categories')
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-warning" type="submit">Delete</button>
                      @endcan
                 </form>
             </td>
         </tr>
         @endforeach
     </table>
     <div style="margin-left:600px;">
     <iframe name="iframe1" src="target.html" allowtransparency = "true" style="width:500px;height:500px; background : transparent; text-align: center;
     border-radius:50px; "></iframe>
</div>
</body>
 @endsection