@extends('layouts.master')
@section('content')
<br><br><br><br><br><br>
<div class="container">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Identifiant</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$user->id}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$user->name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{$user->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Role</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{  $user->type}}
                    </div>
                  </div>
                  <hr>
                
                  
                 
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
              @endsection