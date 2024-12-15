<?php

use Illuminate\Support\Facades\Route;
use App\Models\UserInfo;

// 22. 將查詢結果以 JSON 格式輸出
Route::get('/userinfo', function () {
    $users = UserInfo::all();
    return response()->json($users);
});
