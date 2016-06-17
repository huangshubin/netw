<?php
/**
 * Created by PhpStorm.
 * User: shubin
 * Date: 6/16/2016
 * Time: 5:26 PM
 */

namespace App\Pay\Alipay;


use App\Pay\Alipay;
use App\Pay\IPaymentService;
use App\Pay\IPayService;

class AliDirectPayService implements IPayService
{

    protected $config;
    public function __construct()
    {
        $this->config=require('alipay.config.php');
    }

    public function pay($orderNo,$subject,$body,$fee)
    {

        $parameter =[
            "service"       => $this->config['service'],
            "partner"       => $this->config['partner'],
            "seller_id"  => $this->config['seller_id'],
            "payment_type"	=> $this->config['payment_type'],
            "notify_url"	=> $this->config['notify_url'],
            "return_url"	=> $this->config['return_url'],
            "anti_phishing_key"=>$this->config['anti_phishing_key'],
            "exter_invoke_ip"=>$this->config['exter_invoke_ip'],
            "out_trade_no"	=> $orderNo,
            "subject"	=> $subject,
            "total_fee"	=> $fee,
            "body"	=> $body,
            "_input_charset"	=> trim(strtolower($this->config['input_charset']))
          ];

        $para = $this->buildRequestPara($parameter);

        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' 
        action='".$this->config['alipay_gateway']."?_input_charset=".trim(strtolower($this->config['input_charset']))."'
         method='post'>";
        foreach ($para as $key=>$val) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        $sHtml = $sHtml."<input type='submit' style='display:none;'></form>";

        $sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";

        return $sHtml;

    }

    public function verifyNotify($request)
    {
        $inputs=$request->all();
        if(empty($inputs)) return false;

        $isSign = $this->getSignVerify($inputs, $inputs["sign"]);

        $responseTxt = 'false';
        if (! empty($inputs["notify_id"])) {$responseTxt = $this->getResponse($inputs["notify_id"]);}
        
        if (preg_match("/true$/i",$responseTxt) && $isSign) {
            return true;
        }
        else
        {
            return false;
        }
    }
    private function getResponse($notify_id) {
        $transport = strtolower(trim($this->config['transport']));
        $partner = trim($this->config['partner']);
        $verifyUrl = '';
        if($transport == 'https') {
            $verifyUrl = $this->config['https_verify_url'];
        }
        else {
            $verifyUrl = $this->config['http_verify_url'];
        }
        $verifyUrl = $verifyUrl."partner=" . $partner . "&notify_id=" . $notify_id;
        $responseTxt = AlipayHelper::getHttpResponseGET($verifyUrl, $this->config['cacert']);

        return $responseTxt;
    }
   private function getSignVerify($para_temp, $sign) {

        $para_filter =AlipayHelper::paraFilter($para_temp);

        $para_sort = AlipayHelper::argSort($para_filter);

        $preStr = AlipayHelper::createLinkstring($para_sort);

        $isSign = false;
        switch (strtoupper(trim($this->config['sign_type']))) {
            case "RSA" :
                $isSign = AlipayHelper::rsaVerify($preStr, trim($this->config['ali_public_key_path']), $sign);
                break;
            default :
                $isSign = false;
        }

        return $isSign;
    }
   private function buildRequestPara($para_temp) {
        $para_filter =AlipayHelper::paraFilter($para_temp);

        $para_sort =AlipayHelper::argSort($para_filter);

        $sign = $this->buildRequestSign($para_sort);

        $para_sort['sign'] = $sign;
        $para_sort['sign_type'] = strtoupper(trim($this->config['sign_type']));
        return $para_sort;
    }
    private function buildRequestSign($para_sort) {
        $preStr = AlipayHelper::createLinkstring($para_sort);

        $sign = "";
        switch (strtoupper(trim($this->config['sign_type']))) {
            case "RSA" :
                $sign = AlipayHelper::rsaSign($preStr, $this->config['private_key_path']);
                break;
            default :
                $sign = "";
        }

        return $sign;
    }
    function query_timestamp() {
        $url = $this->config['alipay_gateway']."service=query_timestamp&partner=".trim(strtolower($this->config['partner']))."&_input_charset=".trim(strtolower($this->config['input_charset']));
        $encrypt_key = "";

        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;

        return $encrypt_key;
    }

}