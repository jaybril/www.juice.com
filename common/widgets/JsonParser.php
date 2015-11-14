<?php
/**
 * Created by PhpStorm.
 * User: caiso
 * Date: 15-4-8
 * Time: 下午4:08
 */
    namespace common\widgets;
class JsonParser {


    public  static function MyJsonEncode($phparr)
    {
        if(function_exists("json_encode"))
        {
        return json_encode($phparr);
        }
        else
        {
            require_once 'json.class.php';
            $json = new Services_JSON;
            return $json->encode($phparr);
        }
    }

    public static function  GenerateJsonResult($code, $msg)
    {
        $arr["status"] = $code;
        $arr["message"] = $msg;
        $myjson =JsonParser::MyJsonEncode($arr);
        echo $myjson;
    }
}