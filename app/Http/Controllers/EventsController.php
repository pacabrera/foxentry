<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Http\Requests\EventsRequest;
use Auth;

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

        return view("dashboard.events.manage-events", compact('events', 'search'));
    }


    //Showing the add forms
     public function addEvents(){
        return view("dashboard.events.add-events");
    }

	 //Adding to the database
     public function addEventsPost(EventsRequest $request){

              //Handles the file upload
        $file = $request->file('eventPhoto');
        $file = $request->photo;
        if($request->hasFile('eventPhoto')) {
          //Get filename with the extension
          $filenameWithExt = $request->file('eventPhoto')->getClientOriginalName();
          //Get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('eventPhoto')->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload the image
          $path = $request->file('eventPhoto')->storeAs('/public/assets/img/events/', $fileNameToStore);
        }

        else {
          $fileNameToStore = 'no_image.png';
        }

            $events = new Events();
            $events->userID = Auth::user()->id;
            $events->eventName = $request['eventName'];
            $events->eventDateFrom = $request['eventDateFrom'];

        if(empty($request['eventDateTo'])){
            $events->eventDateTo = $request['eventDateFrom'];
        }
        else{
            $events->eventDateTo = $request['eventDateTo'];
        }
            $events->eventVenue = $request['eventVenue'];
            $events->eventTime = $request['eventTime'];
            $events->eventPhoto = $fileNameToStore;
            $events->eventFee = $request['eventFee'];            
            $events->save();

            //swal()->success('Successfully Added',[]);
            return redirect()->route('manage-events');
    }

 	//Function for edit view
     public function editEvents(Request $request, $id){

        $events = Events::find($id);
        return view("dashboard.events.edit-events", compact('events'));
    }

    //Function edit about
     public function editEventsPost(EventsRequest $request, $eventsID)
    {
	        $events = Events::find($eventsID);

	               //Handles the file upload
        $file = $request->file('eventPhoto');
        $file = $request->photo;
        if($request->hasFile('eventPhoto')) {
          //Get filename with the extension
          $filenameWithExt = $request->file('eventPhoto')->getClientOriginalName();
          //Get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('eventPhoto')->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload the image
          $path = $request->file('eventPhoto')->storeAs('/public/assets/img/events/', $fileNameToStore);
        }

        else {
          $fileNameToStore = 'no_image.png';
        }

            $events->userID = Auth::user()->id;
            $events->eventName = $request['eventName'];
            $events->eventDateFrom = $request['eventDateFrom'];
        
        if(empty($request['eventDateTo'])){
            $events->eventDateTo = $request['eventDateFrom'];
        }
        else{
            $events->eventDateTo = $request['eventDateTo'];
        }
            $events->eventVenue = $request['eventVenue'];
            $events->eventTime = $request['eventTime'];
            $events->eventPhoto = $fileNameToStore;
            $events->eventFee = $request['eventFee'];            
            $events->save();

         // swal()->success('Successfully Edited',[]);
	        return back();
	    }



    //Function for delete
    public function deleteEvents(Request $request, $id){

        $events = Events::find($id);
        if($events) {
          $events->delete();

          return back()->with('success', 'Successfully deleted!');
        // swal()->success('Successfully Deleted',[]);
        }

        else {
          return back()->with('error', 'Error.');
        }

        return redirect()->route('manage-events');
    }
    
}
