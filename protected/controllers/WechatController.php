<?php
/**
 * Created by PhpStorm.
 * User: hongzhiyuan
 * Date: 2016/9/27
 * Time: 21:52
 */
class WechatController extends Controller
{
    public function actionIndex() {
        $check = $this->checkSignature();
        if ($check) {
            echo $_GET["echostr"];
        } else {
            echo "";
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
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