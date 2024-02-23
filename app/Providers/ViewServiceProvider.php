<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\CartComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function register(){

    }

    public function boot(){
        View::composer('header', MenuComposer::class);
        View::composer('cart', CartComposer::class);
    }
}