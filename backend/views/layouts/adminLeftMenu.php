<ul>
    <li>
        <img src="/img/u175.png" alt="" />网站管理
        <ul class="submenu">
             <li <?php  echo $admin_cur=="web" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$setting_url?>">网站设置</a></li>
            <li <?php echo $admin_cur=="admin" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$adminUserManger_url?>">后台用户管理</a></li>
            <li <?php echo $admin_cur=="jion" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$joinList_url?>">加盟管理</a></li>

        </ul>
    </li>
    <li>
        <img src="/img/u187.png" alt="" />素材管理
        <ul class="submenu">
            <li <?php echo $admin_cur=="material" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$materialManger_url?>">素材分类</a></li>
            <li <?php echo $admin_cur=="banner" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$bannerList_url?>">首页banner</a></li>
        </ul>
    </li>
    <li>
        <img src="/img/u187.png" alt="" />新闻管理
        <ul class="submenu">
            <li <?php echo $admin_cur=="article" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$articleManger_url?>">新闻管理</a></li>
            <li <?php echo $admin_cur=="articleCat" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$articleCat_url?>">鲜橙生活</a></li>
            <li <?php echo $admin_cur=="articleCat" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$articleCat_url?>">文章分类</a></li>

        </ul>
    </li>
<li>
	<img src="/img/u124.png" alt="" />产品管理
	<ul class="submenu">
		<li <?php echo $admin_cur=="product" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$productManger_url?>">产品管理</a></li>
		<li <?php echo $admin_cur=="seller" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$sellerManger_url?>">商家管理</a></li>
		<li <?php echo $admin_cur=="type" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$productCat_url?>">产品类别</a></li>
	</ul>
</li>
<li>
	<img src="/img/u118.png" alt="" />活动管理
	<ul class="submenu">
		<li <?php echo $admin_cur=="activity" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$activityList_url?>">活动管理</a></li>
		<li <?php echo $admin_cur=="activitywater" ? "class='active'" : "" ?>><a href="<?php echo \common\widgets\Variable::$activityWater_url?>">活动流水</a></li>
	</ul>
</li>



<!--<li <?php echo $admin_cur=="article" ? "class='active'" : "" ?> >
	<a href="articlemanage.php"><img src="img/u25.png" alt="" />文章管理</a>
</li>
<li <?php echo $admin_cur=="activity" ? "class='active'" : "" ?> >
	<a href="activitymanage.php"><img src="img/u118.png" alt="" />活动管理</a>
</li>
<li <?php echo $admin_cur=="discount" ? "class='active'" : "" ?> >
	<a href="discountmanage.php"><img src="img/u130.png" alt="" />优惠管理</a>
</li>
<li <?php echo $admin_cur=="product" ? "class='active'" : "" ?> >
	<a href="productmanage.php"><img src="img/u124.png" alt="" />产品管理</a>
</li>	
<li <?php echo $admin_cur=="seller" ? "class='active'" : "" ?> >
	<a href="sellermanage.php"><img src="img/u169.png" alt="" />商家管理</a>
</li>
<li <?php echo $admin_cur=="type" ? "class='active'" : "" ?> >
	<a href="producttype.php"><img src="img/u175.png" alt="" />产品类别</a>
</li>
<li <?php echo $admin_cur=="brand" ? "class='active'" : "" ?> >
	<a href="productbrand.php"><img src="img/u181.png" alt="" />产品品牌</a>
</li>
<li <?php echo $admin_cur=="material" ? "class='active'" : "" ?> >
	<a href="materialmanage.php"><img src="img/u187.png" alt="" />素材管理</a>
</li>-->
</ul>
