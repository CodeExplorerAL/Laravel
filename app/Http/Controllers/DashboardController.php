<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

// 3. 在路由端轉到另外一個路由 (與 web.php 搭配)
class DashboardController extends Controller
{
    //- 3-2-1
    public function index()
    {

        return Redirect::route('profile');
    }

    //- 3-2-2
    public function show()
    {
        return to_route('profile', ['user' => 'BB']);
    }



    //- 3-3-1
    public function ss()
    {
        return redirect()->intended('/apple');
    }

    //- 3-3-2
    public function sss()
    {
        return redirect()->intended(route('home'));
    }
}
