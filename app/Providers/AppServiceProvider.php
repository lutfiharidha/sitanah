<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Penjual;
use App\Tanah;
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
        View::share('sellers', Penjual::all());
        View::share('tanah', Tanah::all());
        View::share('tanahLhok', Tanah::where('kota', 'Lhokseumawe')->get());
        View::share('tanahAU', Tanah::where('kota', 'Aceh Utara')->get());
    }
}
