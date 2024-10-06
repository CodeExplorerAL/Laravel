<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 11-2.路由轉控制器引用（ 與 MyCheck.php & web.php 搭配 ）
class ExampleController extends Controller
{
    public function index()
    {
        return '成功來到控制器!';
    }
}
