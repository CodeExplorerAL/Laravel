<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


// 10.建立 Model (與 web.php & FormController.php & form.blade.php & answer.blade.php 搭配)
class MyModel extends Model
{
    use HasFactory;

    //- 15-3.Model版( web.php & UserController.php & index.blade.php & MyModel.php )
    protected $table = 'UserInfo';

    // 運算邏輯放在這裡
    public function add(Request $request)
    {
        // 驗證輸入
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        // 獲取輸入並計算
        $a = $request->input('a');
        $b = $request->input('b');
        $answer = $a + $b;

        return [
            'a' => $a,
            'b' => $b,
            'answer' => $answer,
        ];
    }
}
