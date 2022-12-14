<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Here * means - in all of your views $nameUser variable is available.
        view()->composer('*', function ($view) {
            $nameUser = $this->getNameUser();
            $view->with(['nameUser' => $nameUser]);
        });
        Paginator::useBootstrapFive();
    }
    public function getNameUser()
    {
        $name = null;
        if (Auth::check()) {
            $name = Auth::user()->name;
            $name = explode(" ", $name);
            $name = $name[sizeof($name) - 2] . " " . $name[sizeof($name) - 1];
        }
        return $name;
    }
}
