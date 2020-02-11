<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidationRequest;

class UserController extends Controller
{
    //
    public function login(ValidationRequest $request){
    	$name = $request->get('username');
    	$password = $request->get('password');

    	if (Auth::attempt(['name' => $name, 'password' => $password])) {
            return redirect()->intended('/');
        }else{
        	return 1;
        }  

    }
}
