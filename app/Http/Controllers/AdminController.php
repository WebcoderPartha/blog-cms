<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function index(){
        $user = Auth::user();
        return view('admin.index', ['user' => $user]);
    }


}
