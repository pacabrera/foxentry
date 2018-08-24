<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class eventssController extends Controller
{
	public function __construct()
    {
        $this->middleware('CheckIfAdmin:role');
    }

    //Showing data in about table
     public function manageeventss(Request $request) {

      $search = $request['search'];

        if(request()->has('search')) {
          $events = events::where(function ($query) {
            $query->where('eventName', 'LIKE', '%'.request('search').'%');
          })
          ->orderBy('eventsDate', 'asc')
          ->paginate(10);
        }

        else {
          $events = events
          ::join('users', 'events.id', '=', 'users.id')
          ->select('users.id', 'users.name', 'events.*')
          ->orderBy('eventDate', 'asc')
          ->paginate(10);
        }

        return view("dashboard.events.manage-events", compact('events', 'search'));
    }


    //Showing the add forms
     public function addevents(){
        return view("dashboard.events.add-events");
    }

	 //Adding to the database
     public function addeventsFunc(eventsRequest $request){

            $events = new events();
            $events->id = Auth::user()->id;
            $events->heading = $request['heading'];
            $events->caption = $request['caption'];
            $events->phoneNo = $request['phoneNo'];
            $events->address = $request['address'];
            $events->save();

            swal()->success('Successfully Added',[]);
            return redirect()->route('manage-events');
    }

 	//Function for edit view
     public function editevents(Request $request, $eventsID){

        $events = events::find($eventsID);
        return view("dashboard.events.edit-events", compact('events'));
    }

    //Function edit about
     public function editeventsPost(Request $request, $eventsID)
    {
	       $request->validate([
	          'heading' => 'required|string|max:225',
	          'caption' => 'required|string',
	          'phoneNo' => 'required|string|max:225',
	          'address' => 'required|string|max:225',
	       
	        ]);

	        $events = events::find($eventsID);

	        if($events) {
	 			$events->heading = $request['heading'];
	            $events->caption = $request['caption'];
	            $events->phoneNo = $request['phoneNo'];
	            $events->address = $request['address'];
	            
		        $events->save();

          swal()->success('Successfully Edited',[]);
	        return back();
	    }

}

    //Function for delete
    public function deleteevents(Request $request, $eventsID){

        $events = events::find($eventsID);
        if($events) {
          $events->delete();

         swal()->success('Successfully Deleted',[]);
        }

        else {
          return back()->with('error', 'Error.');
        }

        return redirect()->route('manage-events');
    }
}
