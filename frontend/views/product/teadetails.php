<?php
use frontend\assets\AppAsset;
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
				
				<div class="teaDet-con cl">
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
								<div class="teaDet-list-con">¥<?=$ProductList->productPrice?> / 1包</div>
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
						你选购了产品：<?=$ProductList->productName." ".$ProductList->origin." ".$ProductList->artsId?> <b class="teaDet-bottom-b" id="productCount"></b>包。
					</div>
					<div class="teaDet-bottom-center">共需支付：<span class="teaDet-bottom-span"></span></div>
					<a href="javascript:addCart()" class="cartNum"><i class="fa fa-cart-plus"></i>加入购物车</a>
				</div>
			</div>		
	</div>

    <div class="teadetails-con container">

	<div class="teadetails-conHead">
		<a href="<?php echo common\widgets\FVariable::$productTeadetails_url ?>" class="active">商品介绍</a>
		<a href="<?php echo common\widgets\FVariable::$productTeadetailsrate_url ?>">商品评价</a>
		<div class="teadeta-line"></div>
	</div>
		<?php
		 if($articleList){
			 echo $articleList->content;
		 }else{
		?>

	<div class="section">

			<p class="page-txt">景阳青茶园地处鲁东南风景秀丽的磴山脚下，茶园北依世界五大太阳崇拜起源地日照天台山，西邻黄海九寨沟，原生态环境保护极好，公司下设栗香茶叶专业合作社、茶厂、茶业研究所、网络营销中心,是山东省较早导入CIS战略的现代化茶叶生产、加工、销售和茶文化传播企业，是山东省茶叶生产加工技术研究推广中心和山东省茶叶工程技术研究中心实验点,现有高级农艺师2名</p>
			<p class="page-img"><img src="/img/1.jpg" class="img-responsive" /></p>

	</div>

	<div class="section">

			<p class="page-txt">景阳青茶园地处鲁东南风景秀丽的磴山脚下，茶园北依世界五大太阳崇拜起源地日照天台山，西邻黄海九寨沟，原生态环境保护极好，公司下设栗香茶叶专业合作社、茶厂、茶业研究所、网络营销中心,是山东省较早导入CIS战略的现代化茶叶生产、加工、销售和茶文化传播企业，是山东省茶叶生产加工技术研究推广中心和山东省茶叶工程技术研究中心实验点,现有高级农艺师2名</p>
			<p class="page-img"><img src="/img/3.jpg" class="img-responsive" /></p>

	</div>

	<div class="section">

			<p class="page-txt">景阳青茶园地处鲁东南风景秀丽的磴山脚下，茶园北依世界五大太阳崇拜起源地日照天台山，西邻黄海九寨沟，原生态环境保护极好，公司下设栗香茶叶专业合作社、茶厂、茶业研究所、网络营销中心,是山东省较早导入CIS战略的现代化茶叶生产、加工、销售和茶文化传播企业，是山东省茶叶生产加工技术研究推广中心和山东省茶叶工程技术研究中心实验点,现有高级农艺师2名</p>
			<p class="page-img"><img src="/img/2.jpg" class="img-responsive" /></p>

	</div>

	<div class="section">
		  	<p class="page-txt">景阳青茶园地处鲁东南风景秀丽的磴山脚下，茶园北依世界五大太阳崇拜起源地日照天台山，西邻黄海九寨沟，原生态环境保护极好，公司下设栗香茶叶专业合作社、茶厂、茶业研究所、网络营销中心,是山东省较早导入CIS战略的现代化茶叶生产、加工、销售和茶文化传播企业，是山东省茶叶生产加工技术研究推广中心和山东省茶叶工程技术研究中心实验点,现有高级农艺师2名</p>
			<p class="page-img"><img src="/img/2.jpg" class="img-responsive" /></p>
	</div>
<?php } ?>
	</div>
</div>

