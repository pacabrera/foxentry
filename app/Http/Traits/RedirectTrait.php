<?php

namespace App\Http\Traits;   // Or the place where the trait is stored (step 2)

use Illuminate\Http\Request;

trait RedirectTrait
{
 /**
 * Where to redirect users after register/login/reset based in roles.
 *
 * @param \Iluminate\Http\Request  $request
 * @param mixed $user
 * @return mixed
 */
public function RedirectBasedInRole(Request $request, $user) {

  $route = '';

  switch ($user->role) {
    # Admin
    case 'SUPERADMIN':
      $route = '/admin/dashboard/';  // the admin's route
    break;

    # Employee
    case 'ADMIN':
      $route = '/dashboard/'; // the employee's route
    break;

    # User
    case 'STUDENT':
       $route = '/home';   // the user's route
      break;

      default: break;
    }

    return redirect()->intended($route);
  }

}