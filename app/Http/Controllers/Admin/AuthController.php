<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |
    |   this method will verify admin login proccess
    |
    */
    public function submit(LoginRequest $request){
        if (auth()->guard('admin')->attempt($request->only('email','password'),($request->input('remember')) ? true : false)) {
                return redirect()->to('/home');
        } else {
                return redirect(route('login.preview'))->withErrors('Wrong Login Credentials');
        }
    }
    /*
    |
    |   this method will used to logout admin
    |
    */
    public function logout(){
		auth()->guard('admin')->logout();
        return redirect('/login');
	}
}
