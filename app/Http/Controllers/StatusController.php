<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\status;
use App\comment;
use Auth;

class StatusController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    //Adding to the database
     public function addStatus(Request $request){

            $status = new status();
            $status->uid = Auth::user()->id;
            $status->posts = $request['posts'];
           
            $status->save();
            return back();
    }
    public function viewStatus(){
    	$status = status::join('users', 'statuses.uid', '=', 'users.id')->get();

    	$comments = comment::join('users', 'comments.uid', '=', 'users.id')
    	->join('statuses', 'statuses.statusId', '=', 'comments.pid')
    	->where('comments.pid','statuses.statusId')
    	->get();
    	return view('home', compact('status','comments'));
    }
}
