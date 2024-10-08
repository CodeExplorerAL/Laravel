<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; //- 15-2.控制器版( web.php & UserController.php & index.blade.php )
use App\Models\MyModel;

class UsersController extends Controller
{
    //- 15-2.控制器版( web.php & UserController.php & index.blade.php )
    // public function index()
    // {
    //     $users = DB::select('select * from UserInfo');

    //     return view('index', ['users' => $users]);
    // }

    //- 15-3.Model版( web.php & UserController.php & index.blade.php & MyModel.php )
    public function show()
    {
        $users = MyModel::all();
        return view('index', ['users' => $users]);
    }
}
