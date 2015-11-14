<?php
use common\widgets\FVariable;
use common\widgets\GlobalArray;
?>
    
    <div class="evaluate">
		<div class="evaluate-title">
			<a href="<?=FVariable::$userViporder_url?>">我的订单</a><span> > </span>评价订单
		</div>
    	<div class="evaluate-head">
    		<div>商品信息</div>
    		<div>购买时间</div>
    		<div>评价</div>
    	</div>
    	<div class="evaluate-con">
			<?php
			foreach($orderDetailList as $detk=>$detv){
            if($detv['isEvaluate']==0){
			?>
			<div>
				<div class="eva-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$detv['productLogo']?>" /><?=$detv['productName']?></div>
				<div><?php echo date('Y-m-d',strtotime($details->orderPayTime)); ?></div>
				<div class="publish">发表评价</div>
				<div class="eva-show publish-eva-show">
					<div class="triangle"></div>
					<div class="triangle triangleed"></div>
					<div class="eva-con">
						<div class="score publishScore">
							<div>评分：</div>
							<div class="score-i">
								<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								<span class="score-span">0分</span>

							</div>

						</div>
						<div class="help-block" id="error<?=$detv['id']?>"></div>
						<div class="idea">
							<div>心得：</div>
							<div>
									<textarea class="idea-textarea"></textarea>
								    <input type="hidden" class="idea-hidden" id="score<?=$detv['id']?>">
								    <div class="help-block" id="ierror<?=$detv['id']?>"></div>
									<p><a href="javascript:PublishRate(<?=$detv['id']?>)">发表评价</a></p>
								    <input type="hidden" id="orderId" value="<?=$details->id?>" />
								    <input type="hidden" id="orderNo" value="<?=$details->orderNo?>" />
								    <input type="hidden" id="productId" value="<?=$detv['productId']?>" />
							</div>
						</div>

					</div>
				</div>
			</div>
			<?php
			   }else{
				$comment = new \frontend\models\Comment();
				$commentLook = $comment->findByIdSelect($userId,GlobalArray::$commentTypeConstantArray['product'],$detv['id']);
			?>

				<div>
					<div class="eva-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$detv['productLogo']?>" /><?=$detv['productName']?></div>
					<div><?php echo date('Y-m-d',strtotime($details->orderPayTime)); ?></div>
					<div class="see">查看评价</div>
					<div class="eva-show see-eva-show">
						<div class="triangle"></div>
						<div class="triangle triangleed"></div>
						<div class="eva-con">
							<div class="score">
								<div>评分：</div>
								<div class="score-i">
									<?php
									if($commentLook->score==5){
										for($i=0;$i<$commentLook->score;$i++){
											echo "<i class='fa fa-star'></i>";
										}
									}else{
										for($i=0;$i<$commentLook->score;$i++){
											echo "<i class='fa fa-star'></i>";
										}
										for($j=0;$j<(5-$commentLook->score);$j++){
											echo "<i class='fa fa-star-o'></i>";
										}
									}
									?>
									<span class="score-span"><?=$commentLook->score?>分</span>
								</div>
							</div>
							<div class="idea">
								<div>心得：</div>
								<div><?=$commentLook->content?></div>
							</div>
						</div>
					</div>
				</div>

			<?php } }?>
    	</div>
    </div>
