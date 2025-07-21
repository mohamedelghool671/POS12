<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ربط الواجهة مع الريبو
        $this->app->bind(\App\Interfaces\ProductRepositoryInterface::class, \App\Repositories\ProductRepository::class);
        $this->app->bind(\App\Interfaces\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Interfaces\OrderRepositoryInterface::class, \App\Repositories\OrderRepository::class);
        $this->app->bind(\App\Interfaces\SaleRepositoryInterface::class, \App\Repositories\SaleRepository::class);
        $this->app->bind(\App\Interfaces\PaymentRepositoryInterface::class, \App\Repositories\PaymentRepository::class);
        $this->app->bind(\App\Interfaces\RoleChangeRepositoryInterface::class, \App\Repositories\RoleChangeRepository::class);
        $this->app->bind(\App\Interfaces\SaleInfoRepositoryInterface::class, \App\Repositories\SaleInfoRepository::class);
        $this->app->bind(\App\Interfaces\DashboardRepositoryInterface::class, \App\Repositories\DashboardRepository::class);
        $this->app->bind(\App\Interfaces\AuthRepositoryInterface::class, \App\Repositories\AuthRepository::class);
        $this->app->bind(\App\Interfaces\ShopRepositoryInterface::class, \App\Repositories\ShopRepository::class);
        $this->app->bind(\App\Interfaces\UserDashboardRepositoryInterface::class, \App\Repositories\UserDashboardRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // تعيين اللغة الافتراضية
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale('ar'); // اللغة الافتراضية العربية
        }

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->count();
            } else {
                $cartCount = 0;
            }
            $view->with('cartCount', $cartCount);
        });

        Paginator::useBootstrap();
    }
}
