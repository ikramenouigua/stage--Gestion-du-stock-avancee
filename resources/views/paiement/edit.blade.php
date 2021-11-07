@extends('layouts.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 id="titre-edit">Type du paiement</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('paiement.index') }}" id="ack-btn"> <img src="/images/back.png"></a>
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
  
    <form action="{{ route('paiement.update',$paiement->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom de la ville:</strong>
                    <input type="text" name="type" value="{{ $paiement->type }}" class="form-control" >
                </div>
            </div>
          
           
           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" id="confirm-btn">Confirmer les modifications</button>
            </div>
        </div>
   
    </form>
@endsection
