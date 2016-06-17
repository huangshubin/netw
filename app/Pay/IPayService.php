<?php
/**
 * Created by PhpStorm.
 * User: shubin
 * Date: 6/16/2016
 * Time: 5:23 PM
 */

namespace App\Pay;


use Illuminate\Support\ServiceProvider;

interface IPayService
{
   public  function pay($orderNo,$subject,$body,$fee);
   public function verifyNotify($request);
}