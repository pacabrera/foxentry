<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\status;
use App\comment;
use Auth;
use App\User;

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
    	$status = status::join('users', 'statuses.uid', '=', 'users.id')
        //->join('comments','comments.statusId','statuses.statusId')
        ->get();
    	return view('home', compact('status','posts'));
    }

    public function deleteStatus(Request $request, $id){

        $status = status::find($id);
        if($status) {
          $status->delete();

          return back()->with('success', 'Successfully deleted!');
        // swal()->success('Successfully Deleted',[]);
        }

        else {
          return back()->with('error', 'Error.');
        }

        return redirect()->route('home');
    }
}
