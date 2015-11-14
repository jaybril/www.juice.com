<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/17
 * Time: 17:38
 */
    namespace common\widgets;
    use frontend\models\Order;
    use backend\models\SmsLog;
    use yii\debug\models\search\Log;
    use yii\helpers\Html;
    use yii\log\Logger;
    use yii\widgets\Breadcrumbs;
    use Yii;
    use common\widgets\sms\SendTemplateSMS;
    use common\widgets\GlobalArray;


class Tool{
    /*获得当前IP
     *
     */
    static function getIp()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
        {
            $onlineip = getenv('HTTP_CLIENT_IP');
        }elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
        {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
        {
            $onlineip = getenv('REMOTE_ADDR');
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
        {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    /*
     *输出编码后的字符串
     * @pram $string  需要输出的字符串
     * @pram $default 当该$string为空时 输出的默认的字符串
     */
    public static function echoEncodeString($string,$default=''){
        if($string!='0') {
            $string = $string ? $string : $default;
        }
        return Html::encode($string);
    }
    /*
     *星号替换函数
     * @pram $str 需要替换的字符串
     * @pram $start 字符串的何处开始替换
     * 　if(正数) => 在第 start 个偏移量开始替换
     *   if(负数) => 在从字符串结尾的第 start 个偏移量开始替换
     *   if(0) => 在字符串中的第一个字符处开始替换
     * @pram length 规定要替换多少个字符。
     *  if(正数) =>被替换的字符串长度，从左往右
　　 *  if(负数) => 被替换的字符串长度，从右往左
　　 *  if(0) => 如果start为正数，从start开始向左到最后
     */
    public static function replaceStringWithStar($str, $start, $length = 0,$type='*'){
        $i = 0;
        $star = '';
        //在第 start 个偏移量开始替换
        if($start >= 0) {
            if($length > 0) {
                $str_len = strlen($str);//获取字符串的长度
                $count = $length;
                if($start >= $str_len) {//当开始的下标大于字符串长度的时候，就不做替换了
                    $count = 0;
                }
            }elseif($length < 0){
                $str_len = strlen($str);//获取字符串的长度
                $count = abs($length);//返回长度的绝对值
                if($start >= $str_len) {//当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
                    $start = $str_len - 1;
                }
                $offset = $start - $count + 1;//起点下标减去数量，计算偏移量
                $count = $offset >= 0 ? abs($length) : ($start + 1);//偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
                $start = $offset >= 0 ? $offset : 0;//从最左边或左边的某个位置开始
            }else {
                $str_len = strlen($str);
                $count = $str_len - $start;//计算要替换的数量
            }
        }else {
            if($length > 0) {
                $offset = abs($start);
                $count = $offset >= $length ? $length : $offset;//大于等于长度的时候 没有超出最右边
            }elseif($length < 0){
                $str_len = strlen($str);
                $end = $str_len + $start;//计算偏移的结尾值
                $offset = abs($start + $length) - 1;//计算偏移量，由于都是负数就加起来
                $start = $str_len - $offset;//计算起点值
                $start = $start >= 0 ? $start : 0;
                $count = $end - $start + 1;
            }else {
                $str_len = strlen($str);
                $count = $str_len + $start + 1;//计算需要偏移的长度
                $start = 0;
            }
        }
        while ($i < $count) {
            $star .= $type;
            $i++;
        }

        if(preg_match("/[\x7f-\xff]/", $str)){
            if(Tool::checkStrIsUTF8($str)){
                return substr_replace($str,$type,$start*3, $count*3);
            }
            else{
                return substr_replace($str,$type,$start*2, $count*2);
            }
        }else{
            return substr_replace($str,$type,$start, $count);
        }
        return str_replace($str, $star, $type, $count);
    }
    /*
     *检查字符串是否为UTF-8
     * @pram $str  需要检查的字符串
     * @return true =>是utf-8字符串
     * @return false=>不是
     *
     */
    static function checkStrIsUTF8($str){
        if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$str) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$str) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$str) == true) {
            return true;
        }else {
            return false;
        }
    }
    /*
     *设置面包屑
     */
    static function setBreadcrumbs($arr){
        $linksArr=[];
        foreach($arr as $k=>$v){
            $url=null;
            if(isset($v[1])){
                $url=$v[1];
            }
            $template=null;
            if(isset($v[2])){
                $template=$v[2];
            }
            $class="<li>{link}</li>";
            if(isset($v[3])){
                $class=$v[3];
            }
            array_push($linksArr,[
                'label'=>$v[0] ? $v[0]:'',
                'url'=>$url,
                'template'=>$template,
                'options'=>['class'=>$class]
            ]);
        }
        return  Breadcrumbs::widget([
            'homeLink'=>['label' => '主 页','url' => Yii::$app->homeUrl],
            'links' => $linksArr
        ]);
    }
    /*
     *生成订单号
     * 英文字母、年月日、Unix 时间戳和微秒数、随机数生成订单号
     * @return 订单号
     */
    public static function getOrderNumber(){
        $yCode= date('y');//年份数
        $mCode=date('m');//月份
        $dCode=date('d');//日
        $tCode=substr(time(), -3);//时间戳的后五位
        $iCode=substr(microtime(), 2, 3);//返回时间戳和微秒数，从第二位开始取3位
        $rCode=sprintf('%02d', rand(0, 99));//返回0~99的随机整数
        $orderNo=$yCode. ''. $mCode.'' . $dCode.'' . $tCode.'' . $iCode.'' .$rCode;
        while(Order::findOne($orderNo)){
            $orderNo=Tool::getOrderNumber();
        }
        return $orderNo;
    }
    /*
     *短信验证码
     * @pram
     * @pram $type 发送短信类型 对应Variable里的短信变量
     * @pram $mobile 接收短信的手机
     * @pram $userId 用户id 有必要是填写 （如在找回密码时需要用）
     * @pram $orderId 订单id 有必要是填写(如发货通知、支付成功时需要用)
     *
     * @return
     * -true  短信发送成功
     * -false 短信发送失败
     */
    public  static function sendSms($type,$mobile,$userId='',$orderId='')
    {
        switch($type){
            case 0://注册
                $code=sprintf('%06d', rand(100000, 999999));
                $templateId=GlobalArray::$smsTemplateIdArr[$type];
                $isOk= SendTemplateSMS::sendTemplateSMS($mobile, array($code, '5'),$templateId );
                if($isOk){
                    $templateContent='【云通讯】您使用的是云通讯短信模板，您的验证码是'.$code.'，请于5分钟内正确输入';
                    (new SmsLog())->insertLog($mobile,$templateContent,$code,$type,$userId, $templateId,$orderId);
                }
                return true;
                break;
            case 1://找回密码
                $code=sprintf('%06d', rand(100000, 999999));
                $templateId=GlobalArray::$smsTemplateIdArr[$type];
                $isOk= SendTemplateSMS::sendTemplateSMS($mobile, array($code, '5'),$templateId );
                if($isOk){
                    $templateContent='【云通讯】您使用的是云通讯短信模板，您的验证码是'.$code.'，请于5分钟内正确输入';
                    (new SmsLog())->insertLog($mobile,$templateContent,$code,$type,$userId, $templateId,$orderId);
                }
                return true;
                break;
            case 2://支付成功
                break;
            case 3://app短信下载
                break;
        }
    }
    /**
     * get_contents
     * 服务器通过get请求获得内容
     * @param string $url       请求的url,拼接后的
     * @return string           请求返回的内容
     */
    static  function get_contents($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);  //true =启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果成功只将结果返回，不自动输出任何内容

        curl_setopt($ch, CURLOPT_HEADER, false);//设定是否输出页面内容
        curl_setopt($ch, CURLOPT_HTTPGET, 1); // post,get 过去
        $filecontent=curl_exec($ch);  //执行一个cURL会话
        curl_close($ch);
        return $filecontent;
    }
    /*
     * getExpressInfoByOrder
     * 获得快递的运单信息
     *
     * request
     * @pram $expressCode -快递名称拼音 在快递方式里的code可查询到
     * @pram $expressNo   -快递单号
     * return
     * false -快递信息查询失败，请重试
     * array -返回快递信息数组，成功
     * eg： Array(
    [0] => Array
        (
            [time] => 2015-10-19 13:51:40
            [context] => 在广东广州天河区石牌公司赛马场分部进行签收扫描，快件已被 拍照 签收
        )

    [1] => Array
        (
            [time] => 2015-10-19 13:48:00
            [context] => 在广东广州天河区石牌公司赛马场分部进行派件扫描；派送业务员：庄瑞洪；联系电话：18613084505
        )
    ）
     */
    static function getExpressInfoByOrder($expressCode,$expressNo){
        if(!($expressCode &&  $expressNo)){
            return false;
        }
//        $kuaidi100Api='http://m.kuaidi100.com/query?type='.$expressCode.'&postid='.$expressNo;
        $aikuaidi='http://www.aikuaidi.cn/rest/?key=699133d413ee49c9a58a915494614446&order='.$expressNo.'&id='.$expressCode.'&ord=desc&show=json';

        $res= (Tool::get_contents($aikuaidi));
        $json=json_decode($res);
        if(!$res){
            return false;
        }
//status	订单跟踪状态：
//0：查询出错（即errCode!=0），
//1：暂无记录，
//2：在途中，
//3：派送中，
//4：已签收，
//5：拒收，
//6：疑难件
//7：退回
        if($json->errCode=='3'){
           Yii::getLogger()->log('快递接口访问次数达到最大额度',Logger::LEVEL_INFO);
            return false;
        }
        if($json->errCode!='0'){
            return false;
        }
//        $list=[];
//        foreach($json->data as $k=>$v){
//            array_push($list,[
//                'time'=>$v->time,
//                'context'=>$v->context
//            ]);
//        }
        return $json;
    }
}

