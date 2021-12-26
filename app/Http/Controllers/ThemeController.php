<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /*
    |
    |   this method will show landing page
    |
    */
    public function landing(){
        return view('login');
    }
    /*
    |
    |   this method will show login page
    |
    */
    public function preview(){
        return view('login');
    }

    /*
    |
    |   this method will show login page
    |
    */
    public function home(){
        return view('dashboard.home');
    }
}
