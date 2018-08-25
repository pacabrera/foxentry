@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <a href="{{ route('register') }}">Add User</a>
<p>Users:
  <strong>
    {{ $users->count() }}
  </strong>
</p>

@if($users->count() <= 0)
<span style="color:red">
  No users found!
</span>
@else
<table style="width: 100%">
  <tr>
    <th>NAME</th>
    <th>Student No.</th>
    <th>ROLE</th>
    <th>ACTION</th>
    <th>ACTION</th>
  </tr>

<!--Getting all of the data on users table-->
@foreach($users as $user)
<form action="{{ route('delete-user', $user->id) }}" method="POST">
  @csrf
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->studno }}</td>
    <td>{{ $user->role }}</td>
    <td><a href="{{ route('edit-user', $user->id) }}" class="btn btn-info">EDIT</a></td>
    <td><input type="submit" onclick="confirmDeleteFunction()" class="btn btn-danger" value="DELETE"></td>
  </tr>
</form>
@endforeach
<!--End of Getting all of the data on users table-->
</table>

<br/>

<!--Start of Paginate Function-->
{{ $users->appends(['search' => $search])->links() }}
<!--End of Paginate Function-->
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
