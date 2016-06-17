<?php
/**
 * Created by PhpStorm.
 * User: shubin
 * Date: 6/16/2016
 * Time: 4:24 PM
 */

namespace App\Pay;


 use Illuminate\Support\Facades\Facade;

 class PayGateway extends Facade
{
     protected static function getFacadeAccessor()
     {
         return 'pay';
     }
}