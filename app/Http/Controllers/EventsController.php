<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function __construct()
    {
        $this->middleware('CheckIfAdmin:role');
    }

    //Showing data in about table
     public function manageEvents(Request $request) {

      $search = $request['search'];

        if(request()->has('search')) {
          $event = event::where(function ($query) {
            $query->where('heading', 'LIKE', '%'.request('search').'%');
          })
          ->orderBy('created_at', 'desc')
          ->paginate(10);
        }

        else {
          $event = event
          ::join('users', 'event.id', '=', 'users.id')
          ->select('users.id', 'users.name', 'event.*')
          ->orderBy('created_at', 'asc')
          ->paginate(10);
        }

        return view("dashboard.event.manage-event", compact('event', 'search'));
    }


    //Showing the add forms
     public function addevent(){
        return view("dashboard.event.add-event");
    }

	 //Adding to the database
     public function addeventFunc(eventRequest $request){

            $event = new event();
            $event->id = Auth::user()->id;
            $event->heading = $request['heading'];
            $event->caption = $request['caption'];
            $event->phoneNo = $request['phoneNo'];
            $event->address = $request['address'];
            $event->save();

            swal()->success('Successfully Added',[]);
            return redirect()->route('manage-event');
    }

 	//Function for edit view
     public function editevent(Request $request, $eventID){

        $event = event::find($eventID);
        return view("dashboard.event.edit-event", compact('event'));
    }

    //Function edit about
     public function editeventPost(Request $request, $eventID)
    {
	       $request->validate([
	          'heading' => 'required|string|max:225',
	          'caption' => 'required|string',
	          'phoneNo' => 'required|string|max:225',
	          'address' => 'required|string|max:225',
	       
	        ]);

	        $event = event::find($eventID);

	        if($event) {
	 			$event->heading = $request['heading'];
	            $event->caption = $request['caption'];
	            $event->phoneNo = $request['phoneNo'];
	            $event->address = $request['address'];
	            
		        $event->save();

          swal()->success('Successfully Edited',[]);
	        return back();
	    }

}

    //Function for delete
    public function deleteevent(Request $request, $eventID){

        $event = event::find($eventID);
        if($event) {
          $event->delete();

         swal()->success('Successfully Deleted',[]);
        }

        else {
          return back()->with('error', 'Error.');
        }

        return redirect()->route('manage-event');
    }
}
