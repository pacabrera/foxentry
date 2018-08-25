@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('events') }}">Events</a>
                </div>  <br>

                <h1>EVENTS</h1>
                     <div class="row">
@foreach($events as $event)
                      <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="{{ asset('storage/assets/img/events/'. $event->eventPhoto) }}"  style="width:100%">
                            <div class="caption">
                            <p>{{ $event->eventName }}</p> <br>
@if($event->eventDateFrom == $event->eventDateTo)
                            <p>{{ date('F d, Y', strtotime($event->eventDateFrom)) }}</p>
@else         
                            <p>{{ date('F d, Y', strtotime($event->eventDateFrom)) }} to {{ date('F d, Y', strtotime($event->eventDateTo)) }}</p>
@endif
<form method="POST" action="{{ route('register-event', $event->eventId) }}">
@csrf

                            <p>{{ $event->eventVenue }}</p>
                            <p>{{ $event->evenTime }}</p>
                            <p>{{ $event->eventFee }}</p>
                             <button type="submit" class="btn btn-info">Register</button></a>
</form>    
                            </div>
    
                        </div>
                      </div>
@endforeach  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
