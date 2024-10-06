<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 7.建立 Controller (與 web.php 搭配)
    public function __invoke()
    {
        return view('welcome');
    }


    // 8.連接路由與 Controller
    public function redirectto($urlID)
    {
        switch ($urlID) {
            case 1:
                $url = 'https://www.google.com';
                break;
            case 2:
                $url = 'https://tw.yahoo.com';
                break;
            default:
                $url = 'https://www.apple.com';
        }
        return redirect()->away($url);
    }
}
