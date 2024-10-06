<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ExampleController;
use App\Http\Middleware\MyCheck;
use App\Http\Middleware\AnotherMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('welcome');
});



// 1.設定路由
Route::get('/hello', function () {
    return 'Hello, Laravel!';
});



// 2.路由中的參數
//- 訪問時若沒給參數會Internal Server Error
// Route::get('/hey/{name?}', function ($name) {
//     return 'Hello' . $name;
// });

//- 參數有預設值
Route::get('/hey/{name?}', function ($name = 'laravel') {
    return 'Hello' . $name;
});



// 3.在路由端轉到另外一個路由
//- 方法一
Route::redirect('/hi', '/hey/AA');

Route::redirect('/apple', 'https://www.apple.com');

//- 方法二 (與DashboardController搭配)
//- 3-2-1
Route::get('/dashboard', [DashboardController::class, 'index']);

//- 3-2-2
Route::get('/dashboards', [DashboardController::class, 'show']);

//- 3-2-1 & 3-2-2
Route::get('/profile/{user?}', function ($user = 'AA') {
    return $user;
})->name('profile');

//- 方法三 (與DashboardController搭配)
//- 3-3-1
Route::get('/dashboardss', [DashboardController::class, 'ss']);

//- 3-3-2
Route::get('/dashboardsss', [DashboardController::class, 'sss']);



// 4.給路由取名字
Route::get('/aloha', function () {
    return view('welcome');
})->name('home');



// 5.建立 view (與 home.blade.php 搭配)
Route::get('/home', function () {
    return view('home');
});



// 6.傳資料到 View (與 home.blade.php 搭配)
Route::get('/home/{str}', function ($str) {
    return view('home', ['data' => $str]);      //- 寫法一
    // return view('home')->with('data', $str);             //- 寫法二
});


// 7.建立 Controller (與 HomeController.php 搭配)
Route::get('tohome', HomeController::class);



// 8.連接路由與 Controller (與 HomeController.php 搭配)
Route::get('to/{id}', [HomeController::class, 'redirectto']);



// 9.表單設計 (與 FormController.php & form.blade.php & answer.blade.php 搭配)
//- 顯示表單的路由
Route::get('/form', [FormController::class, 'showForm'])->name('form');

//- 處理表單提交的路由
Route::post('/form/submit', [FormController::class, 'action'])->name('form.submit');



// 10.建立 Model (與 Form2Controller.php & form2.blade.php & answer2.blade.php & MyModel.php 搭配)
//- 顯示表單的路由
Route::get('/form2', [FormController::class, 'showForm2'])->name('form2');

//- 處理表單提交的路由
Route::post('/form/submit2', [FormController::class, 'action2'])->name('form.submit2');



// 11.中間件 Middleware 使用
//- 11-1.單個路由引用（ 與 MyCheck.php 搭配 ）
Route::get('/example', function () {
    return '單個路由引用 成功';
})->middleware(MyCheck::class);

//- 11-2.路由轉控制器引用（ 與 MyCheck.php & ExampleController.php 搭配 ）
Route::get('/example1', [ExampleController::class, 'index'])
    ->middleware(MyCheck::class);

//- 11-3.全局註冊（ 與 AppServiceProvider.php & MyCheck.php 搭配 ）
Route::get('/example2', function () {
    return '全局註冊 成功';
});

//- 11-4.路由組引用（ 與 AppServiceProvider.php & MyCheck.php 搭配 ）
Route::middleware([MyCheck::class])->group(function () {
    Route::get('/example3', function () {
        return '路由組引用_1 成功';
    });
    Route::get('/example4', function () {
        return '路由組引用_2 成功';
    });
});

//- 11-5.使用別名（ 與 AppServiceProvider.php & MyCheck.php 搭配 ）
Route::get('/example5', function () {
    return '使用別名_成功';
})->middleware('my.check');

//- 11-6.設置優先級（ 與 AppServiceProvider.php & MyCheck.php & AnotherMiddleware.php 搭配 ）
Route::get('/example6', function () {
    // 回傳執行了最後一個中間件的結果，來判斷誰先執行
    return request('middleware_order');
})->middleware([MyCheck::class, AnotherMiddleware::class]);



// 12. BLADE模版
//- 12-1 & 12-2 & 12-4 ( 條件判斷 & For 迴圈 & PHP 區段 )
Route::get("/main/{n}", function ($n) {
    return view('main', ['n' => $n]);
});

//- 12-3.ForEach 迴圈
Route::get('/main', function () {
    // 定義一個陣列
    $arr = ['Apple', 'Banana', 'Cherry', 'Date', 'Elderberry'];

    // 傳遞陣列到視圖
    return view('main', ['arr' => $arr]);
});

//- 12-5. 表單
Route::post('/main', function () {
    return 'POST 請求成功！';
})->name('main');

Route::put('main', function () {
    // 處理 PUT 請求
    return 'PUT 請求成功！';
})->name('main');



// 13. 跳轉網頁
//- 13-1.跳轉到一般網站
Route::get('/test', function () {
    return File::get(public_path() . '/test.html');
});

//- 13-2.跳轉到外部網站
Route::get(
    "/go",
    function () {
        return redirect()->away("https://www.google.com");
    }
);
