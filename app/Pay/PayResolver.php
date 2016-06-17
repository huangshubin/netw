<?php
/**
 * Created by PhpStorm.
 * User: shubin
 * Date: 6/16/2016
 * Time: 7:58 PM
 */

namespace App\Pay;


class PayResolver
{

    private $gateways;
    public  function __construct()
    {
        $this->gateways=require('gateway.config.php');
    }

    
    public function gateway($gatewayName)
    {
        if(array_key_exists($gatewayName,$this->gateways))
        {
           $paymentSerivceCls= $this->gateways[$gatewayName];
            $payService=new $paymentSerivceCls;
            return $payService;
        }
        else
        {
            throw new \Exception('can not find the payment gateway, gateway name:'.$gatewayName);
        }

    }
}