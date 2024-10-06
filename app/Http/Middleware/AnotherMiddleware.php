<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// 11-6.設置優先級 (與 AppServiceProvider.php & web.php &  MyCheck.php 搭配 ）
class AnotherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 在執行後面中間件之前標記這個中間件的執行
        $request->merge(['middleware_order' => 'AnotherMiddleware executed']);
        return $next($request);
    }
}
