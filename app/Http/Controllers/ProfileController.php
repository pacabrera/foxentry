<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   //Function for edit view
     public function editProfile(Request $request, $id){

        $profile = User::find($id);
        return view("profile.edit-profile", compact('profile'));
    }

    //Function edit about
     public function editProfilePost(Request $request, $id)
    {
	    $profile = User::find($id);
	    //Handles the file upload
        $file = $request->file('profile');
        $file = $request->photo;
        if($request->hasFile('profile')) {
          //Get filename with the extension
          $filenameWithExt = $request->file('profile')->getClientOriginalName();
          //Get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('profile')->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Upload the image
          $path = $request->file('profile')->storeAs('/public/assets/img/profile/', $fileNameToStore);
        }

        else {
          $fileNameToStore = 'no_image.png';
        }

            $profile->userID = Auth::user()->id;
            $profile->eventName = $request['eventName'];
            $profile->eventDateFrom = $request['eventDateFrom'];
            $profile->eventVenue = $request['eventVenue'];
            $profile->eventTime = $request['eventTime'];
            $profile->eventPhoto = $fileNameToStore;
            $profile->eventFee = $request['eventFee'];            
            $profile->save();

         // swal()->success('Successfully Edited',[]);
	        return back();
	    }
    
}
