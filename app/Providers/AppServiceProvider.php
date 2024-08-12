<?php

namespace App\Providers;
use Illuminate\Support\Str;
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
        // Str::macro('api', function($data = null , $error = 0 , $message = '')
        // {
        //     return response()->json(
        //         [
        //             'data' => $data ,
        //             'error' => $error ,
        //             'message' => $message,
        //         ]);
        // });

    }
}
