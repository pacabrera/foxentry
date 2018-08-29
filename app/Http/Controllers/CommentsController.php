<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Adding to the database
     public function addComment(Request $request, $id){

            $comments = new comment();
            $comments->uid = Auth::user()->id;
            $comments->statusId = $id;
            $comments->comment = $request['comment'];
           
            $comments->save();
            return back();
    }
}
