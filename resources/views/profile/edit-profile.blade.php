@extends('layouts.app')

@section('content')
<div class="container text-center" >    
  <div class="row">
    <div class="col-sm-10">

      

      <div class="row">
        <div class="col-sm-12">
          <div class="well">

            <h3 id="headers"> PERSONAL INFORMATION </h3> <hr>
         <form method="POST" action="{{ route('edit-profile-post', $profile->id) }}" enctype="multipart/form-data">   
              @csrf
    <div class="row">
        <div class="col-xs-6 form-group">
            <label>FIRSTNAME</label>
            <input class="form-control" type="text"/ name="fname">
        </div>
        <div class="col-xs-6 form-group">
            <label>LASTNAME</label>
            <input class="form-control" type="text"/ name="lname">
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 form-group" name="studno">
            <label>STUDENT NUMBER</label>
            <input class="form-control" type="text"/>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 form-group">
            <label>SPECIALIZATION</label>
            <select class="form-control" name="major">
                  <option value="Animation">Animation</option>
                  <option value="Computer Science"> Computer Science </option>
                  <option value="Web Development">Web Development</option>
                  <option value="Net Administration">Net Administration</option>
            </select>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 form-group">
            <label>EMAIL</label>
            <input class="form-control" type="text" name="email" /> <br>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 form-group">
            <label>Profile</label>
            <input type="file" name="profile" class="form-control">
            <br>
        </div>
    </div>
    <button type="submit" class="btn btn-primary"> Confirm </button>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>   
@endsection
