<?php
use frontend\models\Product;
use frontend\models\Comment;
use common\widgets\GlobalArray;
use common\widgets\FVariable;
?>
    
    <div class="evaluate">
		<div class="evaluate-title">
			<a href="<?=FVariable::$userViporder_url?>">我的订单</a><span> > </span>查看评价
		</div>
    	<div class="evaluate-head">
    		<div>商品信息</div>
    		<div>购买时间</div>
    		<div>查看评价</div>
    	</div>
    	<div class="evaluate-con">
			<?php

			foreach($orderDetailList as $detk=>$detv){
				$product = new Product();
				$product = $product->findByProductId($detv['productId']);
                $comment  = new Comment();
				$comment = $comment->findByIdSelect($details->userId,GlobalArray::$commentTypeConstantArray['product'],$detv['id']);
				?>
				<div>
					<div class="eva-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$product->productLogo?>" /><?=$product->productName?></div>
					<div><?php echo date('Y-m-d',strtotime($details->orderTime)); ?></div>
					<div class="see">查看评价</div>
					<div class="eva-show see-eva-show">
						<div class="triangle"></div>
						<div class="triangle triangleed"></div>
						<div class="eva-con">
							<div class="score">
								<div>评分：</div>
								<div class="score-i">
									<?php
									if($comment->score==5){
										for($i=0;$i<$comment->score;$i++){
											echo "<i class='fa fa-star'></i>";
										}
									}else{
										for($i=0;$i<$comment->score;$i++){
											echo "<i class='fa fa-star'></i>";
										}
										for($j=0;$j<(5-$comment->score);$j++){
											echo "<i class='fa fa-star-o'></i>";
										}
									}
									?>
									<span class="score-span"><?=$comment->score?>分</span>
								</div>
							</div>
							<div class="idea">
								<div>心得：</div>
								<div><?=$comment->content?></div>
							</div>
						</div>
					</div>
				</div>
			<?php }?>
    	</div>
    </div>
