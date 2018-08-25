<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Softon\SweetAlert\Facades\SWAL;  


class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('CheckIfAdmin:role');
    }

    public function manageUsers(Request $request)
    {
        $search = $request['search'];

        if(request()->has('search')) {
          $users = User::where(function ($query) {
            $query->where('name', 'LIKE', '%'.request('search').'%')
            ->orWhere('username', 'LIKE', '%'.request('search').'%');
          })
          ->orderBy('name', 'asc')
          ->paginate(10);
        }

        else {
          $users = User::orderBy('name', 'asc')
          ->paginate(10);
        }

        return view("dashboard.users.manage-users", compact('users', 'search'));
    }

    //Function for edit view
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        return view("dashboard.users.edit-user", compact('user'));
    }

    public function editUserPost(Request $request, $id)
    {
	       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'studno' => 'required|int',
	       
	        ]);

	        $user = user::find($id);

	        if($user) {
	 			$user->name = $request['name'];
	            $user->email = $request['email'];
	            $user->password = $request['password'];
	            $user->studno = $request['studno'];
	            
		        $user->save();
           swal()->success('Successfully Edited'," Edit",[]);
	        return redirect()->route('manage-users');
	    }

}

//Function for delete user
    public function deleteUser(Request $request, $id)
    {
        user::find($id)->delete();
        swal()->success('Successfully Deleted'," News is successfully deleted",[]);
        return redirect()->route('manage-users');
    }


}



