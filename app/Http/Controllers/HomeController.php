<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //Showing of Events (Student)
     public function showEvents(Request $request) {

      $search = $request['search'];

        if(request()->has('search')) {
          $events = Events::where(function ($query) {
            $query->where('eventName', 'LIKE', '%'.request('search').'%');
          })
          ->orderBy('eventDateFrom', 'asc')
          ->paginate(10);
        }

        else {
          $events = Events
          ::join('users', 'events.userID', '=', 'users.id')
          ->select('users.id', 'users.name', 'events.*')
          ->orderBy('eventDateFrom', 'asc')
          ->paginate(10);
        }

        return view("events.index", compact('events', 'search'));
    }


    
}
