<?php
/**
 * Created by PhpStorm.
 * User: shubin
 * Date: 6/16/2016
 * Time: 5:23 PM
 */

namespace App\Pay;


use Illuminate\Support\ServiceProvider;

 class PayProvider extends ServiceProvider
{
    public function register()
    {
       $this->app->singleton('pay',function(){
           return new PayResolver();
       });
    }
}