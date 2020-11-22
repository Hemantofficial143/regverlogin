<?php

namespace Jangid\Regverlogin;
use Illuminate\Support\ServiceProvider;

class RegverloginServiceProvider extends ServiceProvider{
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'regverlogin');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }
    public function register(){
        
    }
}