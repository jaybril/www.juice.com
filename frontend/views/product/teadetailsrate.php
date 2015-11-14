<?php
use frontend\assets\AppAsset;
use common\widgets\Tool;
use common\widgets\GlobalArray;
AppAsset::register($this);
AppAsset::addScript($this,"/js/jquery.imagezoom.min.js");
?>
<?php $this->beginBlock('test') ?>
$(document).ready(function(){

$(".bigimg-jqzoom").imagezoom();



});
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
    <div class="teadetails" id="teadetails">

	<div class="section">

			<div class="teaDet container">
<!--				<p class="teaDet-share">喜大奔普：<a href=""><img src="/img/fx2.png" /></a><a href=""><img src="/img/fx1.png" /></a><a href=""><img src="/img/u109.png" /></a><a href=""><img src="/img/fx3.png" /></a><a href=""><img src="/img/fx5.png" /></a></p>-->
				
				<div class="teaDet-con">
					<div class="teaDet-con-left">
						<div class="bigimg"><img src="/img/index_11.png" class="img-responsive bigimg-jqzoom" rel="/img/index_11.png" /></div>
						<div class="smallimg cl">
							<div class="smallimg-div">
								<ul class="smallimg-ul">
									<?php
									$active = "active";
									foreach($MaterialList as $k=>$v){

										if($k!=0){
											$active = "";
										}
										?>
										<li class="smallimg-li <?=$active?>"><img src="<?=GlobalArray::$imgUrlArray['0'].$v->address?>" mid="<?=GlobalArray::$imgUrlArray['0'].$v->address?>" big="<?=GlobalArray::$imgUrlArray['0'].$v->address?>" class="img-responsive" /></li>
										<?php
									}
									?>
								</ul>
							</div>
							<?php
							if(count($MaterialList)>4){
								?>
								<ol>
									<li class="prev">&lt;</li>
									<li class="next">&gt;</li>
								</ol>
							<?php }?>
						</div>
					</div>
					<div class="teaDet-con-right">
						<h2 class="teaDet-right-name"><?=$ProductList->productName?></h2>
						<div class="teaDet-list">
							<?php
							if($ProductList->origin){
								?>
								<div>
									<div class="teaDet-list-name"><b>产</b>地：</div>
									<div class="teaDet-list-con"><span class="active"><?=$ProductList->origin?></span></div>
								</div>
							<?php } ?>
							<?php
							if($ProductList->artsId){
								?>
								<div>
									<div class="teaDet-list-name"><b>工</b>艺：</div>
									<div class="teaDet-list-con"><span class="active"><?=$ProductList->artsId?></span></div>
								</div>
							<?php } ?>
							<div class="teaDet-right-price">
								<div class="teaDet-list-name"><b>售</b>价：</div>
								<div class="teaDet-list-con">¥<?=$ProductList->productPrice?> 1包</div>
							</div>
							
							<div class="teaDet-right-number">
								<div class="teaDet-list-name"><b>数</b>量：</div>
								<div class="teaDet-list-con">
									<?php
									$productStock = $ProductList->productStock;
									if($productStock>=5 && $productStock<10){
										?>
										<span class="active"><b class="teaDet-num">5</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*5);?></b></span>
									<?php } ?>
									<?php if($productStock>=10 && $productStock<15){ ?>
										<span class="active"><b class="teaDet-num">5</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*5);?></b></span>
										<span><b class="teaDet-num">10</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*10);?></b></span>
									<?php } ?>
									<?php if($productStock>=15 && $productStock<20){ ?>
										<span class="active"><b class="teaDet-num">5</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*5);?></b></span>
										<span><b class="teaDet-num">10</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*10);?></b></span>
										<span><b class="teaDet-num">15</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*15);?></b></span>
									<?php } ?>
									<?php if($productStock>=20){ ?>
										<span class="active"><b class="teaDet-num">5</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*5);?></b></span>
										<span><b class="teaDet-num">10</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*10);?></b></span>
										<span><b class="teaDet-num">15</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*15);?></b></span>
										<span><b class="teaDet-num">20</b>包<br />￥<b class="teaDet-price"><?=sprintf("%.2f", $ProductList->productPrice*20);?></b></span>
									<?php } ?>
									<span class="last-span">
										<input type="button" class="last-span-cut" value="-" /><input type="text" class="teaDet-text" value="1" readonly /><input type="button" class="last-span-plus" value="+" />
										<input type="hidden" class="teaDet-hiddenSum" value="<?=$ProductList->productStock?>" />
										<input type="hidden" class="teaDet-hiddenPrice" value="<?=sprintf("%.2f",$ProductList->productPrice)?>" />
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="teaDet-bottom">
					<div class="teaDet-bottom-left">
						你选购了一下产品：<?=$ProductList->productName." ".$ProductList->origin." ".$ProductList->artsId?> <b class="teaDet-bottom-b" id="productCount"></b>包。
					</div>
					<div class="teaDet-bottom-center">共需支付：<span class="teaDet-bottom-span"></span></div>
					<a href="javascript:addCart()" class="cartNum"><i class="fa fa-cart-plus"></i>加入购物车</a>
				</div>
			</div>		
	</div>

    <div class="teadetails-con teadetails-coned container">

	<div class="teadetails-conHead">
		<a href="<?php echo common\widgets\FVariable::$productTeadetails_url ?>">商品介绍</a>
		<a href="<?php echo common\widgets\FVariable::$productTeadetailsrate_url ?>" class="active">商品评价</a>
		<div class="teadeta-line"></div>
	</div>

		<ul class="teadetailsrate-ul">
			<?php
			if($commentList){
				 foreach($commentList as $comk=>$comv){
			?>
			<li>
				<div class="teade-lileft">
					<p class="teade-comcon"><?=$comv['content']?></p>
					<p><?=$comv['publishTime']?></p>
				</div>
				<div class="teade-licenter">
					<p>满意度：<?php for($i = 0;$i<$comv['score'];$i++){ ?><i class="fa fa-star"></i><?php }?></p>
				</div>
				<div class="teade-liright">
					<p>会员：<?=Tool::replaceStringWithStar($comv['nickName'],1,2)?></p>
				</div>
			</li>
        <?php } }?>


		</ul>

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

