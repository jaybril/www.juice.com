<?php
use common\widgets\FVariable;
?>
		
	<div class="container">
		<div class="paysuccess">
			<div class="w650">
				<div class="pay-head">
					<p class="pay-h-title"><i class="fa fa-check"></i> 订单号为：<?=$out_trade_no?> 支付成功！</p>
					<p class="pay-h-subtitle">感谢你对我们的支持与信任，我们将尽快为你发货，把好茶送到你府上。</p>
					<p class="pay-h-a"><a href="<?=\Yii::$app->urlManager->
						createUrl([FVariable::$userOrderwaitdel_url,'id'=>$out_trade_no])?>">查看订单</a><a href="<?=FVariable::$productTeadetails_url?>">再次购买</a></p>
				</div>
<!--				<div class="pay-share">-->
<!--					<p class="pay-s-title">我所理解的分享，是把好消息告诉朋友，让他们也可以体验到我此刻的幸福与喜悦。</p>-->
<!--					<div class="pay-s-con cl">-->
<!--						<a href=""><img src="/img/fx2.png" /><span>|</span>分享给微信朋友</a>-->
<!--						<a href=""><img src="/img/fx1.png" /><span>|</span>分享到朋友圈</a>-->
<!--						<a href=""><img src="/img/fx4.png" /><span>|</span>分享给QQ好友</a>-->
<!--						<a href=""><img src="/img/fx3.png" /><span>|</span>分享到QQ空间</a>-->
<!--						<a href=""><img src="/img/fx5.png" /><span>|</span>分享到新浪微博</a>-->
<!--					</div>-->
<!--				</div>-->
			</div>			
		</div>
	</div>
