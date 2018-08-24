@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                 <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
 
                <div class="links">
                    <a href="{{ route('manage-users') }}">Users</a>

                    <a href="{{ route('manage-events') }}">Events</a>
                </div>
                <hr>
                <a href="{{ route('add-event') }}">Add Event</a>
<p>Events:
  <strong>
    {{ $events->count() }}
  </strong>
</p>

@if($events->count() <= 0)
<span style="color:red">
  No events found!
</span>
@else
<table style="width: 100%">
  <tr>
    <th>Name</th>
    <th>Date</th>
    <th>Venue</th>
    <th>Time</th>
    <th>Photo</th>
    <th>Fee</th>
  </tr>

<!--Getting all of the data on events table-->
@foreach($events as $event)
<form action="{{ route('delete-event', $event->eventId) }}" method="POST" name="myForm">
  @csrf
  <tr>
    <td>{{ $event->eventName }}</td>
@if($event->eventDateFrom == $event->eventDateTo)
    <td>{{ date('F d, Y', strtotime($event->eventDateFrom)) }}</td>
@else
    <td>{{ date('F d, Y', strtotime($event->eventDateFrom)) }} to {{ date('F d, Y', strtotime($event->eventDateTo)) }} </td>
@endif
    <td>{{ $event->eventVenue }}</td>
    <td>{{ $event->eventTime }}</td>
    <td>{{ $event->eventPhoto }}</td>
    <td>{{ $event->eventFee }}</td>
    <td><a href="{{ route('edit-event', $event->eventId) }}" class="btn btn-info">EDIT</a></td>
    <td><button class="btn btn-danger">DELETE</button></td>
  </tr>
</form>
@endforeach
<!--End of Getting all of the data on events table-->
</table>

<br/>

<!--Start of Paginate Function-->
{{ $events->appends(['search' => $search])->links() }}
<!--End of Paginate Function-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
@endif
@endsection
