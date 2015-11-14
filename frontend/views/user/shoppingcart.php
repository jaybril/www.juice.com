<?php
use common\widgets\GlobalArray;
use common\widgets\FVariable;
?>
		
	<div class="container">
		<div class="shopping">
			<div class="shop-goback"><a href="<?=FVariable::$userMyshopping_url?>">返回修改购物车</a></div>
			<div class="shopping-one">
				<div class="shop-head">					
					<div>图片</div>
					<div>商品名称</div>
					<div>单价</div>
					<div>数量</div>
					<div>小计</div>
					<div>操作</div>									
				</div>
				<div class="shop-table">
					<?php
					if($cartList){
					foreach($cartList as $cartk=>$cartv){
					?>
				   <div class="shop-tr">
					   	<div class="shop-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$cartv['productLogo']?>" class="img-responsive" /></div>
						<div class="shop-name">
							<p><?=$cartv['productName']?></p>
							<div class="shop-name-table">
								<div class="shop-n-tr">
								    <div><span>产</span>地：<?=\common\widgets\Tool::echoEncodeString($cartv['origin'])?></div>
								    <div><span>工</span>艺：<?=\common\widgets\Tool::echoEncodeString($cartv['artsId'])?></div>
								</div>
							</div>
						</div>
						<div class="shop-price">￥<?=$cartv['productPrice']?> / 包</div>
						<div class="shop-number"><?=$cartv['count']?></div>
						<div class="shop-total">￥<span><?=sprintf("%.2f", $cartv['money'])?></span></div>
						<div class="shop-operate"></div>
				   </div>
					<?php } }?>
				</div>
			</div>
			
			<div class="shopping-two cl">
				<div class="shopp-address shopping-two-default cl">
				<?php
				 if($isDefault){ ?>
				<div class="shop-two-add active">
					<input type="hidden" id="shopaddressId" value="<?=$isDefault['id']?>">
					<p><?=$isDefault['userName']?></p>
					<p><?=$isDefault['province'].' '.$isDefault['city'].' '.$isDefault['area'].' '.$isDefault['detailAddress']?></p>
					<p><?=$isDefault['userMobile']?></p>
				</div>
				<?php }?>

				<div class="shop-two-last">
					<a href="/user/addaddress">+添加配送地址</a>
				</div>
				</div>

				<div class="shopp-address shopping-two-more cl">
				<?php
				if($addressModel){
					foreach($addressModel as $addressk=>$addressv){

				?>
			   <div class="shop-two-add">
				  <input type="hidden" id="shopaddressId" value="<?=$addressv['id']?>">
			   	 <p><?=$addressv['userName']?></p>
			   	 <p><?=$addressv['province'].' '.$addressv['city'].' '.$addressv['area'].' '.$addressv['detailAddress']?></p>
			   	 <p><?=$addressv['userMobile']?></p>
			   </div>
              <?php
					}

			  ?>
				</div>
				<p class="address-p-show"><span>显示更多<i class="fa fa-angle-double-down"></i></span></p>
				<?php } ?>
			</div>
			
			<div class="shopping-three">
				<div class="shop-three-list">
					<?php
					$allMoney = "";
					foreach($cartList as $mk=>$mv)
					{
						$allMoney += $mv['count']*$mv['productPrice'];
					}
					?>
					<div>
						<div><?=count($cartList)?> 件商品，总商品金额：</div><div>￥<?=sprintf("%.2f",$allMoney)?></div>
					</div>
					<div>
						<div>返现：</div><div>￥0.00</div>
					</div>
					<div>
						<div>运费：</div><div>￥0.00</div>
					</div>
					<div>
						<div>应付金额：</div><div>￥<?=sprintf("%.2f",$allMoney)?></div>
					</div>
				</div>
				<div class="shop-three-payment">
					<input type="hidden" value="<?=sprintf("%.2f",$allMoney)?>" id="TotalPrice" />
					<a href="javascript:submitOrder()" class="ordersubmit">提交订单</a>
				</div>
			</div>
		</div>
	</div>
			
