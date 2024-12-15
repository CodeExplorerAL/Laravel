<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UsersController; //- 15
use App\Http\Middleware\MyCheck;
use App\Http\Middleware\AnotherMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;      //- 15
use App\Models\UserInfo;            // 21.關聯
use App\Models\House;               // 21.關聯
use App\Models\Phone;               // 21.關聯



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



// 13.跳轉網頁
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



// 15.匯入元件與執行 SQL
//- 15-1.路由版
Route::get('/users', function () {
    // 查詢 UserInfo 表中的所有用戶
    $users = DB::select("select * from UserInfo");

    foreach ($users as $user) {
        echo $user->cname . "<br>";
    }
});

//- 15-2.控制器版( web.php & UserController.php & index.blade.php )
Route::get('/users2', [UsersController::class, 'index']);

//- 15-3.Model版( web.php & UserController.php & index.blade.php & MyModel.php )
Route::get('/users3', [UsersController::class, 'show']);



// 16.綁定參數
//- 16-1.語法一
Route::get('/users4', function () {
    $users = DB::select('select * from UserInfo where uid = ?', ['A01']);

    foreach ($users as $user) {
        echo $user->cname . "<br />";
    }
});

//- 16-2.語法二
Route::get('/users5', function () {
    $users = DB::select('select * from UserInfo where uid = :uid', ['uid' => 'A01']);

    foreach ($users as $user) {
        echo $user->cname . "<br />";
    }
});



// 17.SQL 查詢方法
//- 17-1.select
Route::get('/users6', function () {
    $users = DB::select("select * from UserInfo where uid like ?", ['1%']);

    foreach ($users as $user) {
        echo $user->cname . "<br />";
    }
});

//- 17-2.insert
Route::get('/users7', function () {
    // 執行 INSERT 查詢，插入一筆資料
    $affectedRows = DB::insert("insert into UserInfo (uid, cname, PWD) values (?, ?, ?)", ['10100', 'AA', null]);

    // 顯示影響的資料筆數
    echo "插入資料成功，影響的資料筆數為： " . $affectedRows;
});

//- 17-3.update
Route::get('/users8', function () {
    // 執行 UPDATE 查詢，更新一筆資料
    $affectedRows = DB::update("update UserInfo set PWD = ? where uid =?", [null, '1010']);

    // 顯示影響的資料筆數
    echo "更新資料成功，影響的資料筆數為： " . $affectedRows;
});

//- 17-4.delete
Route::get('/users9', function () {
    // 執行 DELETE 查詢，刪除一筆資料
    $affectedRows = DB::delete('delete from UserInfo where uid = ?', ['10100']);

    // 顯示影響的資料筆數
    echo "刪除資料成功，影響的資料筆數為： " . $affectedRows;
});

//- 17-5.scalar
Route::get('/users10', function () {
    // 執行 SELECT 查詢，只傳回一個欄位值
    $affectedRows = DB::scalar('select cname from UserInfo where uid = 1010');

    // 顯示名字
    echo "刪除資料成功，影響的資料筆數為： " . $affectedRows;
});

//- 17-6.statement
Route::get('/users11', function () {
    // 執行 DROP TABLE 指令，沒有傳回值
    DB::statement("drop table Bill");

    echo "資料表已刪除";
});



// 18. TRANSACTION交易
//- 18-1.Exception
Route::get('/transaction1', function () {
    try {
        DB::transaction(function () {
            DB::delete("delete from Live");
            // 嘗試插入資料到 UserInfo 中，如果主索引重複則會出錯並觸發例外
            DB::insert("insert into UserInfo (uid, cname) values ('A01', '吳小美')");
        });

        echo "所有操作成功，已提交變更。";
    } catch (\Exception $e) {
        // 捕獲例外並顯示錯誤訊息
        echo "發生錯誤，操作已回滾：" . $e->getMessage();
    }
});
//- 18-2.Throwable
Route::get('/transaction2', function () {
    try {
        DB::transaction(function () {
            DB::delete("delete from Live");
            DB::insert("insert into UserInfo values ('A01', '吳小美')");
        });
        echo "所有操作成功，已提交變更。";
    } catch (Throwable $e) {
        report($e);
        abort(503);
    }
});
//- 18-3.手動交易
Route::get('/transaction3', function () {
    try {
        // 開始交易
        DB::beginTransaction();

        // 執行一些資料庫操作
        DB::delete("DELETE FROM Live");
        DB::insert("INSERT INTO UserInfo (uid, cname) VALUES ('A01', '吳小美')");

        // 提交交易，將變更寫入資料庫
        DB::commit();

        return "交易成功，資料已提交！";
    } catch (Throwable $e) {
        // 如果有錯誤，回滾交易
        DB::rollBack();

        // 記錄錯誤到日誌
        report($e);

        // 返回 HTTP 503 錯誤
        abort(503, '交易失敗，系統錯誤！');
    }
});



// 19. QUERY BUILDER
//- 19-1.不帶條件
Route::get('/query1', function () {
    $users = DB::table('UserInfo')->get();
    return $users;
});

//- 19-2.帶條件
Route::get('query2', function () {
    $users = DB::table('UserInfo')
        ->where('cname', '王大明')
        ->get();
    return $users;
});

//- 19-3.查詢特定欄位
Route::get('/query3', function () {
    $users = DB::table('UserInfo')
        ->select('uid', 'cname')
        ->get();
    return $users;
});

//- 19-4.取得一筆資料中的特定欄位值
Route::get('query4', function () {
    $cname = DB::table('UserInfo')
        ->where('cname', '王大明')
        ->value('uid');
    echo $cname;
});

//- 19-5.JOIN
Route::get('query5', function () {
    $users = DB::table('UserInfo')

        // join
        ->join('Live', 'UserInfo.uid', '=', 'Live.uid')
        ->join('House', 'Live.hid', '=', 'House.hid')

        // rightjoin
        // ->rightJoin('Live', 'UserInfo.uid', '=', 'Live.uid')
        // ->rightJoin('House', 'Live.hid', '=', 'House.hid')

        // leftjoin
        // ->leftJoin('Live', 'UserInfo.uid', '=', 'Live.uid')
        // ->leftJoin('House', 'Live.hid', '=', 'House.hid')

        // crossjoin
        // ->crossJoin('Live', 'UserInfo.uid', '=', 'Live.uid')
        // ->crossJoin('House', 'Live.hid', '=', 'House.hid')

        ->where('UserInfo.uid', 'A01')
        ->get();
    return $users;
});

//- 19-6.排序
Route::get('query6', function () {
    $users = DB::table('Bill')
        // ->orderBy('fee') // 順向排序
        ->orderBy('fee', 'desc')    // 反向排序
        ->get();
    return $users;
});

//- 19-7.除錯
Route::get('query7', function () {
    // DB::table('UserInfo')->dd();
    // DB::table('UserInfo')->dump();
    // DB::table('UserInfo')->get()->dd();
    DB::table('UserInfo')->get()->dump();
});



// 20.ELOQUENT（ web.php & UserInfo.php->Model ）
//- 20-1.查詢資料
Route::get('eloquent1', function () {
    foreach (UserInfo::all() as $user) {
        echo $user->cname . "<br />";
    }
});

//- 20-2.查詢部分資料
Route::get('eloquent2', function () {
    foreach (UserInfo::where('uid', 'A01')->get() as $user) {
        echo $user->cname . "<br />";
    }
});

//- 20-3.新增資料
Route::get('eloquent3', function () {
    $user = new UserInfo;
    $user->uid = 'Z01';
    $user->cname = '吳小美';

    $user->save();
});

//- 20-4.修改資料-1
Route::get('eloquent4', function () {
    $user = UserInfo::find('Z01');  // find() 函數只找主索引欄位
    $user->cname = '吳美美';
    $user->save();
});

//- 20-4.修改資料-2
Route::get('eloquent5', function () {
    UserInfo::where('uid', 'Z01')
        ->update(['cname' => '吳大美']);
});

//- 20-5.刪除資料-1
// delete 後不用下 save()，如果反悔了，可以下 save() 把資料重新寫回資料庫
Route::get('eloquent6', function () {
    $user = UserInfo::find('Z01');
    $user->delete();
});

//- 20-5.刪除資料-2
// delete 後不用下 save()，如果反悔了，可以下 save() 把資料重新寫回資料庫
Route::get('eloquent7', function () {
    $user = UserInfo::where('uid', 'Z01')->delete();
});

// 21.關聯
//- 21-1. 多對多關聯 查詢
Route::get('/query/{uid}', function ($uid) {
    $user = UserInfo::find($uid);
    echo $user->cname . '<br />';

    foreach ($user->lives as $house) {
        echo $house->address . '<br />';
    }
});

//- 21-2. 多對多關聯 新增
Route::get('/add-house', function () {
    $user = UserInfo::find('A04');
    $house = House::find(4);

    $user->lives()->save($house);
});

//- 21-3. 一對多關聯 查詢
Route::get('/find-phone', function () {
    $house = House::find(1);
    foreach ($house->own as $phone) {
        echo $phone->hid;
    }
});

//- 21-4. 一對多關聯 新增
Route::get('/add-phone', function () {
    $house = House::find(4);
    $phone = new Phone();
    $phone->tel = '1414';
    $house->own()->save($phone);
});

//- 21-5. 一對多關聯經過中間資料表 查詢
Route::get('/find-bill', function () {
    $house = House::find(1);
    foreach ($house->bills as $bill) {
        echo "{$bill->tel} {$bill->dd}: {$bill->fee} <br>";
    }
});
