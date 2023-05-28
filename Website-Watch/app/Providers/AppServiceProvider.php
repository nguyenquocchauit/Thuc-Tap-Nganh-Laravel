<?php

namespace App\Providers;

use App\Models\LikeProduct;
use App\Models\Order;
use App\Models\Product;
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
        Paginator::useBootstrapFive();
        // Here * means - in all of your views $nameUser variable is available.
        view()->composer('*', function ($view) {
            $nameUser = $this->getNameUser();
            $brand = $this->menuBrandForGender();
            $liked = $this->getLikeProduct();
            $yourOrderUnconfirm = $this->OrderUnconfirmed();
            $view->with(['nameUser' => $nameUser, 'brandMenu' => $brand, 'liked' => $liked, 'yourOrderUnconfirm' => $yourOrderUnconfirm]);
        });
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
    public function OrderUnconfirmed()
    {
        $yourOrderUnconfirm = null;
        if (auth()->guard("admin")->check())
            $yourOrderUnconfirm  = Order::where('status', 'XN')
                ->where('employee', auth()->guard("admin")->user()->id)
                ->count();
        return $yourOrderUnconfirm;
    }
    public function menuBrandForGender()
    {
        $women =  Product::query()
            ->join('brands', 'brands.id', '=', 'products.brand')
            ->selectRaw('DISTINCT brands.*, products.brand')
            ->where('gender', '1')
            ->get();
        $men =  Product::query()
            ->join('brands', 'brands.id', '=', 'products.brand')
            ->selectRaw('DISTINCT brands.*, products.brand')
            ->where('gender', '2')
            ->get();
        $brands = ['men' => $men, 'women' => $women];
        return  $brands;
    }
    public function getLikeProduct()
    {
        $liked = LikeProduct::get();
        return $liked;
    }
}
