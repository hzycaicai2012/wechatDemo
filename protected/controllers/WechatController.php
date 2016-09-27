<?php
/**
 * Created by PhpStorm.
 * User: hongzhiyuan
 * Date: 2016/9/27
 * Time: 21:52
 */
define("TOKEN", "hzycaicai");

class WechatController extends Controller
{
    public function actionIndex() {
        $check = $this->checkSignature();
        if ($check) {
            echo isset($_GET["echostr"]) ? $_GET["echostr"] : "";
        } else {
            echo "";
        }
    }

    private function checkSignature()
    {
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}