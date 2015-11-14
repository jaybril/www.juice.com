<?php
    namespace common\alipay;
    header("Content-type:text/html;charset=utf-8");
    class AlipayConfig {
        private $alipay_config = [];
        public function __construct() {
            //合作身份者id，以2088开头的16位纯数字
            $this->alipay_config['partner'] = \Yii::$app->params['alipay']['partner'];
            //收款支付宝账号
            $this->alipay_config['seller_email'] = \Yii::$app->params['alipay']['seller_email'];
            //安全检验码，以数字和字母组成的32位字符
            $this->alipay_config['key'] = \Yii::$app->params['alipay']['key'];
            //签名方式 不需修改
            $this->alipay_config['sign_type'] = strtoupper('MD5');
            //字符编码格式 目前支持 gbk 或 utf-8
            $this->alipay_config['input_charset'] = strtolower('utf-8');
            //ca证书路径地址，用于curl中ssl校验
            //请保证cacert.pem文件在当前文件夹目录中
            $this->alipay_config['cacert'] = str_replace("\\","/", dirname(__FILE__) . '/cacert.pem');
            //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
            $this->alipay_config['transport'] = 'http';
        }

        public function getAliConfig() {
            return $this->alipay_config;
        }
    }
?>