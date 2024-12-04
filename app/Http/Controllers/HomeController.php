<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        if(Auth::id()){
            $isrole = Auth()->user()->role;
            if ($isrole =='user'){
                return view('user/userhome');
            }
            else if ($isrole =='admin'){
                return view('admin/layouts/adminmain');
            }
        }
    }
}
