<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="{{ asset('/storage/assets/img/fe.png')}}" />
  <title>Foxentry</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="keywords" content="Fox Entry, CICT HAU, CICT Portal, Holy Angel University CICT," />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   <script src="{{ asset('js/app.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  $(function () {
   $('.panel-google-plus > .panel-footer > .input-placeholder, .panel-google-plus > .panel-google-plus-comment > .panel-google-plus-textarea > button[type="reset"]').on('click', function(event) {
        var $panel = $(this).closest('.panel-google-plus');
            $comment = $panel.find('.panel-google-plus-comment');
            
        $comment.find('.btn:first-child').addClass('disabled');
        $comment.find('textarea').val('');
        
        $panel.toggleClass('panel-google-plus-show-comment');
        
        if ($panel.hasClass('panel-google-plus-show-comment')) {
            $comment.find('textarea').focus();
        }
   });
   $('.panel-google-plus-comment > .panel-google-plus-textarea > textarea').on('keyup', function(event) {
        var $comment = $(this).closest('.panel-google-plus-comment');
        
        $comment.find('button[type="submit"]').addClass('disabled');
        if ($(this).val().length >= 1) {
            $comment.find('button[type="submit"]').removeClass('disabled');
        }
   });
});
</script>
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="profile.html"><img src="{{ asset('/storage/assets/img/fe.png')}}" width="30" height="30" ></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else

        <li><a href="{{ route('home') }}"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
        <li><a href="{{ route('events') }}"> <span class="glyphicon glyphicon-envelope"></span> Events</a></li>
        <li><a href="#"> <span class="glyphicon glyphicon-globe"></span> Notification</a></li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group input-group">
          <input type="text" class="form-control" placeholder="Search..">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('edit-profile', Auth::user()->id )}}" class="scroll"><span data-hover="Popular Packages">Update Profile</span></a></li>
            <li><a href="updatepass.html" class="scroll"><span data-hover="Recent Trips">Change Password</span></a></li>
            <li><a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
            </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </ul>
        </li> 
      </ul>
    </div>
  </div>
</nav>
            @endguest
            @yield('content')

</body>

</html>
