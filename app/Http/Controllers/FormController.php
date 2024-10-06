<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyModel;

class FormController extends Controller
{
    // 9.表單設計 (與 web.php & form.blade.php & answer.blade.php 搭配)
    public function showForm()
    {
        return view('form'); // 顯示表單
    }

    public function action(Request $request)
    {
        // 驗證輸入 (可選)
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        // 獲取數字 A 和 B
        $a = $request->input('a');
        $b = $request->input('b');
        $answer = $a + $b; // 計算總和

        // 返回結果視圖
        return view('answer', [
            'a' => $a,
            'b' => $b,
            'answer' => $answer
        ]);
    }



    // 10.建立 Model (與 web.php & form.blade.php & answer.blade.php & MyModel.php 搭配)
    private $model;

    public function __construct()
    {
        $this->model = new MyModel(); // 初始化 MyModel
    }

    public function showForm2()
    {
        return view('form'); // 顯示表單
    }

    public function action2(Request $request)
    {
        // 使用 model 處理表單邏輯
        $result = $this->model->add($request);

        // 返回結果視圖
        return view('answer', $result);
    }
}
