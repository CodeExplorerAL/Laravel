<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcessController extends Controller
{
    // 23. 驗證
    public function do(Request $request)
    {
        $request->validate([
            'message' => 'required|max:5',
        ], [
            'message.required' => '訊息欄未輸入資料',
            'message.max' => '訊息欄輸入超過 :max 個字',
        ]);

        return view('success');
    }
}
