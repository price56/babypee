<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $user = User::all();
//        event(new Registered($user));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
