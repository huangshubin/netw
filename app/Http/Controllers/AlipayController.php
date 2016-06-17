<?php

namespace App\Http\Controllers;

use App\Pay\PayGateway;
use App\Pay\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class AlipayController extends Controller
{

    public function show()
    {
        return view('alipay.show');
    }
    public function pay(Request $request)
    {
        $productName=$request->product_name;
        $price=$request->product_price;
        $productID=$request->product_id;

        list($usec, $sec) = explode(" ", microtime());
        list(,$musec)=explode('.',$usec);
        $orderNo=date('YmdHis').$musec.strtoupper(str_random(5));

        $payment=new \App\models\Payment();
        $payment->order_no=$orderNo;
        $payment->fee=$price;
        $payment->product_id=$productID;
        $payment->product_name=$productName;
        $payment->product_details="test";
        $payment->status='pending';

        $payment->save();


      $html= PayGateway::gateway('alipay.direct')->pay($orderNo,$productName,"test",$price);
      return  response($html);
    }
    public function payNotify(Request $request)
    {

        $success= PayGateway::gateway('alipay.direct')->verifyNotify($request);
        if(!$success)
        {
            Log::error('alipay notify verify fails: '.json_encode($request->all()));
            abort(400);
        }


        $orderNo='2016061705250664626100ZJOEI';
        $payment=\App\models\Payment::where('order_no',$orderNo)->first();
        if($payment !=null) {
            $paymentId='1';
            $payment->status = 'finished';
            $payment->payment_id = $paymentId;
            $payment->save();
        }
    }
}
