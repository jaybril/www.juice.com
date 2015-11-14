<?php
use common\widgets\FVariable;
use common\widgets\GlobalArray;
use common\widgets\Tool;
?>

<div class="container">
    <div class="myorder">
        <div class="myorder-head">
            <a href="<?=FVariable::$userVipcenter_url?>">会员中心</a>
            <span>></span>
            <a href="<?=FVariable::$userViporder_url?>">我的订单</a>
            <span>></span>
            订单号 <?=$details->orderNo?>
        </div>

        <div class="myorder-practice cl">
            <div class="finish">
                <div>
                    <p>提交订单</p>
                    <p><?php echo date('Y-m-d',strtotime($details->orderTime)); ?></p>
                    <p><?php echo date('H:i:s',strtotime($details->orderTime)); ?></p>
                </div>
            </div>
            <div class="finish">
                <div>
                    <p>完成支付</p>
                    <p><?php echo date('Y-m-d',strtotime($details->orderPayTime)); ?></p>
                    <p><?php echo date('H:i:s',strtotime($details->orderPayTime)); ?></p>
                </div>
            </div>
            <div>
                <div>
                    <p>商品出库</p>
                </div>
            </div>
            <div>
                <div>
                    <p>等待收货</p>
                </div>
            </div>
            <div>
                <div>
                    <p>完成</p>
                </div>
            </div>
        </div>

        	    	<div class="myorder-handle">
        	    		<div class="myorder-handle-h">
        	    			<div>处理时间</div>
        	    			<div>处理内容</div>
        	    			<div>操作人</div>
        	    		</div>
        	    		<div class="myorder-handle-c">
        	    			<div>
        	    				<div><?=$details->orderTime?></div>
        		    			<div>你提交了订单，请等待系统确认。</div>
        		    			<div>客户</div>
        	    			</div>
        	    			<div>
        	    				<div><?=$details->orderPayTime?></div>
        		    			<div>你完成了支付，请等待发货。</div>
        		    			<div>客户</div>
        	    			</div>
        	    		</div>
        	    	</div>

        <div class="myorder-table">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="order-name">订单编号</td>
                    <td><?=$details->orderNo?></td>
                    <td class="order-name">订单日期</td>
                    <td><?=$details->orderTime?></td>
                    <td class="order-name">订单状态</td>
                    <td><?=GlobalArray::$orderStatusArray[$details->orderStatus]?></td>
                    <td class="order-name">订单金额</td>
                    <td>￥<?=$details->orderMoney?></td>
                </tr>
                <tr>
                    <td class="order-name">收件人</td>
                    <td><?=$addressList['userName']?></td>
                    <td class="order-name">手机号码</td>
                    <td><?=$addressList['userMobile']?></td>
                    <td class="order-name">配送地址</td>
                    <td colspan="3"><?=$addressList['province']." ".$addressList['city']." ".$addressList['area']." ".$addressList['detailAddress']?></td>
                </tr>
            </table>
        </div>

        <div class="myorder-list">
            <div class="shop-head">
                <div>图片</div>
                <div>商品名称</div>
                <div>单价</div>
                <div>数量</div>
                <div>小计</div>
            </div>
            <div class="myshop-table">
                <?php
                foreach($orderDetailList as $detk=>$detv){
                    ?>
                    <div class="shop-tr">
                        <div class="shop-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$detv['productLogo']?>" class="img-responsive" /></div>
                        <div class="shop-name">
                            <p><?=$detv['productName']?></p>
                            <div class="shop-name-table">
                                <div class="shop-n-tr">
                                    <div><span>产</span>地：<?=Tool::echoEncodeString($detv['origin'])?></div>
                                    <div><span>工</span>艺：<?=Tool::echoEncodeString($detv['artsId'])?></div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-price">￥<?=$detv['price']?></div>
                        <div class="shop-number"><?=$detv['productCount']?>包</div>
                        <div class="shop-total">￥<?=$detv['productPrice']?></div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
