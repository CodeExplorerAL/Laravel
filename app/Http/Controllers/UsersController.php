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

    //- 23-2. 密碼驗證
    public function register(Request $request)
    {
        $validator = $request->validate([
            'password' => ['required', 'confirmed'],
            'uid' => 'required|unique:users,uid',
        ], [
            'password.required' => '請輸入密碼',
            'password.confirmed' => '密碼不一致',
            'password.min' => '密碼長度至少為8',
            'password.mixed_case' => '密碼必須包含大小寫字母',
            'password.letters' => '密碼必須包含字母',
            'password.numbers' => '密碼必須包含數字',
            'password.symbols' => '密碼必須包含符號',
            'uid.required' => '請輸入帳號',
            'uid.unique' => '帳號已存在',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
