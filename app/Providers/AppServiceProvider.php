<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.app', function ($view) {
            $invitesCount = 0;
            if (Auth::user()) {
                $invitesCount = Auth::user()->invites()->count();
            }
            $view->with('invitesCount', $invitesCount);
        });
    }
}
