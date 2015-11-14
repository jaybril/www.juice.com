<?php
    namespace common\widgets;
    class  GlobalArray {
        /*
         * 用户性别数组
         */
        public static $userSexArray=[
            '0'=>'男',
            '1'=>'女',
            '2'=>'保密'
        ];
        /*
         * 用户状态数组
         */
        public static $userStatusArray=[
            '0'=>'正常状态',
            '1'=>'冻结状态',
        ];
        /*
        * 第三方登录类型数组
        */
        public static $userJionBindTypeArray=[
            '0'=>'qq',
            '1'=>'新浪微博',
            '2'=>'微信',
            '3'=>'支付宝',
        ];
        /*
         * 交易类型数组
         */
        public static $businessTypeArray=[
            '0'=>'收入',
            '1'=>'支出',
        ];
        /*
       * 流水类型类型数组
       */
        public static $logTypeArray=[
            '0'=>'订单支付',
            '1'=>'充值',
            '2'=>'提现',
            '3'=>'赠送',
        ];
        /*
         * 第三方登录绑定状态数组
         */
        public static $userJionBindStatusArray=[
            '0'=>'取消绑定',
            '1'=>'绑定成功',
        ];
        /*
         * 用户注册来源数组
         */
        public static $userRegComeFromArray=[
            '0'=>'WEB',
            '1'=>'WAP',
            '2'=>'APP'
        ];
        /*
         * 允许上传的图片后缀名
         */
        public  static   $imageTypeArray=[
            'png',
            'jpg',
            'jpeg',
            'gif',
            'PNG',
            'JPG',
            'JPEG',
            'GIF'
        ];
        /*
         * 产品状态数组
         */
        public static $productStatusArray=[
            '0'=>'未上架',
            '1'=>'销售中',
            '2'=>'已下架'
        ];
        /*
         * 订单状态数组
         */
        public static $orderStatusArray=[
            '0'=>'待付款',
            '1'=>'待发货',
            '2'=>'已发货',
            '3'=>'待评论',
            '4'=>'交易成功',
            '5'=>'交易关闭'
        ];
        /*
         *  退货申请状态数组
         */
        public static $refundStatusArray=[
            '0'=>'待审核',
            '1'=>'审核成功，等待用户退货',
            '2'=>'审核失败',
            '3'=>'收到退货，退款处理中',
            '4'=>'退款处理完成',
        ];
        /*
         *支付方式数组
         */
        public static $orderPayMethodArray=[
            '0'=>'支付宝',
            '1'=>'微信支付',
            '2'=>'余额支付',
            ];
        /*
        *支付方式数组常量
         */
        public static $orderPayMethodConstantArray=[
            'alipay'=>'0',
            'weixin'=>'1',
            'yue'=>'2',
        ];

        /*
         *订单来源数组
         */
        public static $orderComeFromArray=[
            '0'=>'WEB',
            '1'=>'WAP',
            '2'=>'APP'
        ];

        /*
         *订单来源数组
         */
        public static $orderComeFromConstantArray=[
            'WEB'=>'0',
            'WAP'=>'1',
            'APP'=>'2'
        ];

        /*
         *商家状态数组
         */
        public static $sellerStatusArray=[
            '0'=>'待审核',
            '1'=>'审核通过',
            '2'=>'已冻结'
        ];
        /*
         * 产品属性状态数组
         */
        public static  $productAttributeStatusArray=[
            '0'=>'无效',
            '1'=>'有效'
        ];
        /*
         * 文章类型数组
         */
        public static $articleTypeArray=[
            '0'=>'长评论',
            '1'=>'新闻',
            '2'=>'商家介绍',
            '3'=>'产品介绍'
        ];
        /*
         * 文章状态数组
         */
        public static $articleStatusArray=[
            '0'=>'待审核',
            '1'=>'审核通过',
            '2'=>'已撤销',
        ];
        /*
         * 是否置顶数组
         */
        public static $isTopArray=[
            '0'=>'不置顶',
            '1'=>'置顶',
        ];
        /*
        * 文章来源数组
        */
        public static $articleSourceArray=[
            '0'=>'自编',
            '1'=>'网页抓取',
        ];
        /*
        * 文章来源数组
        */
        public static $commentTypeArray=[
            '0'=>'文章',
            '1'=>'产品',
        ];
        /*
        * 文章来源数组常量
        */
        public static $commentTypeConstantArray=[
            'article'=>'0',
            'product'=>'1',
        ];
        /*
       * 评论审核状态数组
       */
        public static $commentStatusArray=[
            '0'=>'待审核',
            '1'=>'审核通过',
            '2'=>'已撤销'
        ];
        /*
      * 评论审核状态数组常量
      */
        public static $commentStatusConstantArray=[
            'PendingAudit'=>'0',
            'AuditThrough'=>'1',
            'Revoked'=>'2'
        ];
        /*
         * 素材类型数组
         */
        public static $materialTypeArray=[
            '0'=>'图片',
            '1'=>'视频',
            '2'=>'音频'
        ];
        /*
        * 素材展示方式数组
        */
        public static $materialIsShowArray=[
            '0'=>'可展示在PC和移动端',
            '1'=>'只展示在PC端',
            '2'=>'只展示在移动端'
        ];
        /*
        * 活动展示方式数组
        */
        public static $activityIsShowArray=[
            '0'=>'可展示在PC和移动端',
            '1'=>'只展示在PC端',
            '2'=>'只展示在移动端'
        ];
        /*
        * 短信类型数组
        */
        public static $smsLogTypeArray=[
            '0'=>'注册',
            '1'=>'找回密码短信',
            '2'=>'支付成功',
            '3'=>'app下载短信',
        ];
        /*
        * 快递状态数组
        */
        public static $expressStatusArray=[
            '0'=>'可用',
            '1'=>'不可用',
        ];

        /*
       * 订单是否申请退货
       */
        public static $orderIsRefundArray=[
            'NoApplication'=>'0',
            'Application'=>'1',
        ];

        /*
      * 订单退货申请状态
      */
        public static $orderRefundStatusArray=[
            '0'=>'待审核',
            '1'=>'审核成功，等待用户退货',
            '2'=>'审核失败',
            '3'=>'收到退货，退款处理中',
            '4'=>'退款处理完成',
        ];
        /*
     * 订单退货申请状态常量
     */
        public static $orderRefundConstantArray=[
            'PendingAudit'=>'0',
            'AuditThrough'=>'1',
            'AuditFailure'=>'2',
            'Completed'=>'4',
        ];

        /*
        * 订单状态常量
        */
        public static $orderStateConstantArray=[
            'waitPay'=>'0',        //0-待付款
            'waitDelivery'=>'1',   //1-待发货
            'hasDelivery'=>'2',    //2-确认收货
//            'refund'=>'3',         //3-退款中
            'waitEvaluate'=>'3',   //3-待评论
            'completed'=>'4',      //4-交易成功
            'hasCancel'=>'5',     //5-已关闭
        ];

        /*
* 图片链接
*/
        public static $imgUrlArray=[
            '0'=>'http://www.mingpotea.com:8081',
        ];

        /*
* 产品id
*/
        public static $productIdArray=[
            '0'=>'1',
        ];


        /*
       * 活动状态数组
       */
        public static $activityStatusArray=[
            '0'=>'未开始',
            '1'=>'进行中',
            '2'=>'已暂停',
            '3'=>'已结束',
        ];
        /*
         *短信模板id数组
         */
        public static $smsTemplateIdArr=[
            '0'=>1,
            '1'=>1,
            '2'=>'',
            '3'=>'',
        ];
    }