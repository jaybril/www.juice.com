<?php
use common\widgets\GlobalArray;
use common\widgets\FVariable;
?>
	
	<div class="vipcon">
		<div class="vipcon-left">
			<?php
			$index_vip = "vorder";
			echo   $this->render(FVariable::$layoutVipmenu_view,['index_vip'=>$index_vip]);
			?>
		</div>
		<div class="vipcon-right">
			<div class="order cl">
			    <div class="order-head">
					<?php
					$order_vip = "orderstay";
					$userId =  Yii::$app->session->get(FVariable::$session_userId_str);
					$orderIndex = \frontend\models\Order::find()->where(array('userID'=>$userId))->all();
					$orderStay = \frontend\models\Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitPay']))->all();
					$orderFinish = \frontend\models\Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['completed']))->all();
					$orderEvaluate = \frontend\models\Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitEvaluate']))->all();
					$orderCancel = \frontend\models\Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['hasCancel']))->all();
					echo $this->render(FVariable::$layoutVipordermenu_view,['order_vip'=>$order_vip,'orderIndex'=>$orderIndex,
						'orderStay'=>$orderStay,'orderFinish'=>$orderFinish,'orderEvaluate'=>$orderEvaluate,'orderCancel'=>$orderCancel]);
					?>
			    </div>
			    
			    <div class="order-con">
					<ul>
						<?php
						foreach($orderStayed as $k=>$v){
							echo "<li>";
							echo "<div class='order-con-head'>";
							echo "<span class='ord-number'>订单号：<b>".$v->orderNo."</b></span>";
							echo "<span class='ord-times'>".$v->orderTime."</span>";
							echo "<div class='ord-head-right'><a href='javascript:orderCancel($v->id);'>取消订单</a></div>";
							echo "</div>";
							echo "<div class='order-sub-con'>";
							echo "<div class='sub-con-list'>";
							$order = \frontend\models\Order::findOne($v->id);
							$orderDetail = $order->getProductDetail()->all();
							$addressName = \frontend\models\UserAddress::findOne($v->addressId);
							$addressName = $addressName->userName;
							foreach($orderDetail as $detk=>$detv){
								echo "<div class='sub-row'>";
								echo "<div>";

								$product = \frontend\models\OrderDetail::findOne($detv['id']);
								$product = $product->getProduct()->one();

								echo "<img src='".GlobalArray::$imgUrlArray['0'].$product['productLogo']."' class='img-responsive' />";
								echo "</div>";
								echo "<div>".$product['productName']."</div>";
								echo "<div>".$detv['productCount']."包</div>";
								echo "<div>".'￥'.$detv['productPrice']."</div>";
								echo "</div>";
							}

							echo "</div>";
							echo "<div>￥".$v->orderMoney."</div>";
							echo "<div>".$addressName."</div>";
							echo "<div class='sub-con-details'><span class='orderbtn-danger'>待支付</span><a href='".\Yii::$app->urlManager->
								createUrl([FVariable::$userOrderpay_url,'id'=>$v->orderNo])."'>订单详情</a></div>";
							echo "<div class='sub-con-last'>";
							echo "<a href='".\Yii::$app->urlManager->
								createUrl(['/user/userpayment','id'=>$v->id])."'>支付宝支付</a>";
//							echo "<a href=''>微信支付</a>";
							echo "</div>";
							echo "</div>";
							echo "</li>";
						}
						?>
					</ul>
			    </div>
				<?php
				echo \yii\widgets\LinkPager::widget([
					'pagination' => $pagination,
					'nextPageLabel'=>'下一页',
					'prevPageLabel'=>'上一页',
					'firstPageLabel'=>'首页',
					'lastPageLabel'=>'末页',
					'options'=>['class'=>'orderPage'],
				]);
				?>
			</div>
		</div>
	</div>
