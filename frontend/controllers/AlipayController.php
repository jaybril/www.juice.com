<?php
/**
 * Created by PhpStorm.
 * User: JiaJin Gu
 * Date: 2015/10/22
 * Time: 14:22
 */

    namespace frontend\controllers;
    use common\widgets\FVariable;
    use frontend\models\Order;
    use Yii;
    use common\alipay\AlipayConfig;
    use common\alipay\lib\AlipaySubmit;
    use common\alipay\lib\AlipayNotify;
    use yii\web\Controller;
    use yii\log\Logger;

    class AlipayController extends Controller{
        public  $layout='mingpoMain';//整个controller的布局文件
        //支付类型
        public $payment_type = "1"; //必填，不能修改
        //服务器异步通知页面路径
        public $notify_url = "http://www.mingpotea.com/alipay/notifyurl"; //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        public $return_url = "http://www.mingpotea.com/alipay/returnurl"; //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //商户订单号
        public $out_trade_no = ""; //商户网站订单系统中唯一订单号，必填
        //订单名称
        public $subject = "名坡绿茶WEB端支付宝支付"; //必填
        //付款金额
        public $total_fee = ""; //必填
        //订单描述
        public $body = "";
        //商品展示地址
        public $show_url = ""; //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        //防钓鱼时间戳
        public $anti_phishing_key = ""; //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        public $exter_invoke_ip = "115.28.178.236"; //非局域网的外网IP地址，如：221.0.0.1
        public $parameter = [];
        public $alipay_config =[];
        /*
         *发请支付宝请求
         */
        public function actionAlipayapi(){
            header("Content-type:text/html;charset=utf-8");
            $req=Yii::$app->request;
            $this->out_trade_no=trim($req->post('WIDout_trade_no'));
//            $this->subject=trim($req->post('subject'));
            $this->total_fee=trim($req->post('WIDtotal_fee'));
            $this->body=trim($req->post('body'));

            $this->alipay_config=(new AlipayConfig())->getAliConfig();
            //构造要请求的参数数组，无需改动
            $this->parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($this->alipay_config['partner']),
                "seller_email" => trim($this->alipay_config['seller_email']),
                "payment_type"	=> $this->payment_type,
                "notify_url"	=> $this->notify_url,
                "return_url"	=> $this->return_url,
                "out_trade_no"	=> $this->out_trade_no,
                "subject"	=> $this->subject,
                "total_fee"	=> 0.01,
                "body"	=> $this->body,
                "show_url"	=> $this->show_url,
                "anti_phishing_key"	=> $this->anti_phishing_key,
                "exter_invoke_ip"	=> $this->exter_invoke_ip,
                "_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
            );
           //建立请求
            $alipaySubmit = new AlipaySubmit($this->alipay_config);
            $html_text = $alipaySubmit->buildRequestForm($this->parameter,"get", "确认");
            echo $html_text;
        }
        /*
         *同步通知处理
         */
        public function actionReturnurl(){
            $this->alipay_config=(new AlipayConfig())->getAliConfig();
            $alipayNotify = new AlipayNotify($this->alipay_config);
            $verify_result = $alipayNotify->verifyReturn();
            //验证成功
            if($verify_result) {
                //商户订单号
                $out_trade_no = $_GET['out_trade_no'];
                //支付宝交易号
                $trade_no = $_GET['trade_no'];
                //交易状态
                $trade_status = $_GET['trade_status'];
                if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    $orderModel=new Order();
                    $isOk=$orderModel->updateOrderByOrderNoAndStatus($out_trade_no,1);//支付成功，更新订单状态
                    if(!$isOk){
                        $erorr='订单已经支付成功，但订单状态更新失败 原因不明 订单号：'.$out_trade_no.',发生时间：'.date('Y-m-d H:i:s',time());
                        Yii::getLogger()->log($erorr,Logger::LEVEL_ERROR);
                    }
                   return  $this->render(FVariable::$paySuccess_view,['out_trade_no'=>$out_trade_no]);
                }
                else {
                    echo "trade_status=".$_GET['trade_status'];
                    $erorr='订单已经支付成功，但支付宝返回状态不对 联系支付宝客服查明  单号：'.$out_trade_no.',发生时间：'.date('Y-m-d H:i:s',time());
                    Yii::getLogger()->log($erorr,Logger::LEVEL_ERROR);
                  return  $this->render(FVariable::$payFail_view);
                }
            }
             return   $this->render(FVariable::$payFail_view);
        }
        /*
         *异步通知处理
         */
        public function actionNotifyurl(){
            //计算得出通知验证结果
            $this->alipay_config=(new AlipayConfig())->getAliConfig();
            $alipayNotify = new AlipayNotify($this->alipay_config);
            $verify_result = $alipayNotify->verifyNotify();
            if($verify_result) {//验证成功
                $out_trade_no = $_POST['out_trade_no'];
                //支付宝交易号
                $trade_no = $_POST['trade_no'];
                //交易状态
                $trade_status = $_POST['trade_status'];

                if($_POST['trade_status'] == 'TRADE_FINISHED') {

                }
                else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {

                }
                echo "success";		//请不要修改或删除
            }
            else {
                echo "fail";

            }
        }

    }