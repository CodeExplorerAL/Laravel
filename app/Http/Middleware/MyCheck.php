<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


// 11.使用 Middleware (與 web.php 搭配 ）
class MyCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 檢查 token 的第三字元是否為 5
        if ($request->token[2] != 5) {
            die("error");
        }

        //- 11-6.設置優先級 (與 AppServiceProvider.php & web.php &  AnotherMiddleware.php 搭配 ）
        // 在執行後面中間件之前標記這個中間件的執行
        // $request->merge(['middleware_order' => 'MyCheck executed']);

        return $next($request);
    }
}
