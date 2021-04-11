<?php

namespace App\Http\Responses;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        $role = Auth::user()->role;
        $checkrole = explode(',', $role);

        try {
            if (in_array('admin', $checkrole)) {
                Session::put('isadmin', 'admin');
               return redirect('dashboard');
            } else {
                return redirect('cashier');
            }
        } catch (\Throwable $th) {
            abort('403', 'You are not authorized to access this page.');
        }


    }

}
