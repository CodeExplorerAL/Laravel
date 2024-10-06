<?php

namespace App\Providers;

use App\Http\Middleware\MyCheck;
use App\Http\Middleware\AnotherMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */ public function boot(): void
    {
        //- 11-3.全局註冊（ 與 web.php 搭配 ）
        // $this->app->make(Kernel::class)->pushMiddleware(MyCheck::class);


        //- 11-4.路由組引用（ 與 web.php 搭配 ）
        // $this->app->make(Kernel::class)->appendMiddlewareToGroup('web', MyCheck::class);

        //- 11-5.使用別名（ 與 web.php 搭配 ）
        // $this->app->bind('my.check', MyCheck::class);


        //- 11-6.設置優先級（ 與 web.php & MyCheck.php & AnotherMiddleware.php 搭配 ）
        // $this->app->make(Kernel::class)->prependToMiddlewarePriority(MyCheck::class);
        // $this->app->make(Kernel::class)->prependToMiddlewarePriority(AnotherMiddleware::class);
    }
}
