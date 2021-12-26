<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Requests\Supervisor\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |
    |   this method will verify supervisor login proccess
    |
    */
    public function submit(LoginRequest $request){
        $request['status'] = 'ON';
        if (auth()->guard('supervisor')->attempt($request->only('email','password','status'),($request->input('remember')) ? true : false)) {
                return redirect()->to('/home');
        } else {
                return redirect(route('login.preview'))->withErrors('Wrong Login Credentials');
        }
    }
    /*
    |
    |   this method will used to logout supervisor
    |
    */
    public function logout(){
		auth()->guard('supervisor')->logout();
        return redirect('/login');
	}
}
