@extends('layouts.app')


@section('content')
<div class="row">
<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}" id="back"> Retour</a>
        </div>
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Créer une permission</h2>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nom:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</div>
{!! Form::close() !!}


@endsection