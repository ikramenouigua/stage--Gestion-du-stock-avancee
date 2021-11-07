@extends('layouts.master')
@section('content')
<br><br><br><br><br><br>
 <h1 style="margin-left:300px; COLOR:043335;">Notifications :</h1><br>
    @foreach($notifications as $notification)
        <div class="alert alert-success" style="margin-left:20%; margin-right:2%; background-color:#C1F8FB; COLOR:BLACK;" role="alert">
            [{{ $notification->created_at }}]  : Produit  {{ $notification->data['nom']}} a atteint stock minimal.
            <a href="{{route('markNotification',$notification->id)}}" class="float-right mark-as-read">
                Mark as read
            </a>
        </div>

        
    
    @endforeach

@endsection
