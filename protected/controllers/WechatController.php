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
        /*
        $check = $this->checkSignature();
        if ($check) {
            echo isset($_GET["echostr"]) ? $_GET["echostr"] : "";
        } else {
            echo "";
        }
        */
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        // extract post data
        if (!empty($postStr)){
            Yii::log($postStr, 'info', 'rawInfo');
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if(!empty( $keyword ))
            {
                Yii::log($keyword, 'info', 'keyword');
                $msgType = "text";
                $content = "您的抽奖码是：" . User::model()->getPresentCode($fromUsername, $keyword);
                Yii::log($content, 'info', 'respond');
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
                echo $resultStr;
            }else{
                echo "Input something...";
            }
        }else {
            echo "";
        }
        Yii::app()->end();
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

    public function actionLottery() {

    }

    public function actionStartLottery() {

    }

    public function actionStopLottery() {

    }
}