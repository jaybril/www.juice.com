<?php
use frontend\assets\AppAsset;
use yii\widgets\LinkPager;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/recruit.css');
AppAsset::addScript($this,'@web/js/recruit.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>''])?>
<div class="top_banner"></div>

<div class="content_pg layout1190">
    <div class="tit"><img src="/images/recruit/s.jpg"></div>
    <div class="top">
        <p class="ft24">有一个机会，连接更广阔的世界，走出属于自己的成功之路</p>
        <p class="ft14">我们的雇员是橙汁先生2年来走向成功的基石，在这里，所有的目标和成就，都要依靠雇员的努力实现，因此我们将珍贵的雇员称作“伙伴”。<br/>
            我们永远珍视和尊重伙伴们为橙汁先生带来的一切，也竭尽可能提供机会让你在这里提升自我，找寻职业方向，并且最终实现个人目标。<br/>
            在橙汁先生，你将会发现一条和伙伴们一起走向卓越的路，也会感受到一直以来我们所坚持的对伙伴们和顾客们的尊重，更可以与我们一起践行我们所肩负的企业社会责任。<br/>
            适应性强、充满激情、散发着正能量、富有创造力且重视团队合作是我们一直以来所需要的重要品质，<br/>
            如果你具有这些品质，为什么不把它们带来橙汁先生呢？你的技能和创意正是这个快速发展的团队所需要的，</p>
        <p class="ft16 cl_c">来吧，加入我们，让我们共同迈向一个更美好的未来！<br/>
            我们坚信每个人都有被平等对待的权利，因此每个符合要求的申请者都在我们的考虑范围内！</p>
    </div>
    <div class="t">开放职位</div>
    <div class="box_wp">
        <?php
        foreach($countries as $k=>$v){
            echo '<div class="box">';
            echo '<h3>'.$v->department.'</h3>';
            echo ' <p>'.$v->employName.'<span class="add">'.$v->address.'</span></p>';
            echo ' <a class="show" data-id="'.$v->id.'" href="javascript:void(0)"></a>';
            echo '</div>';
        }
        ?>
<!--        <div class="box">-->
<!--            <h3>研发及品控部</h3>-->
<!--            <p>Assistant QA Manager, Regulatory Affairs<span class="add">上海</span></p>-->
<!--            <a class="show" data-id="2" href="javascript:void(0)"></a>-->
<!--        </div>-->
    </div>
    <style>
        .page {
            float: right;
        }
        a {
            text-decoration: none;
            color: #f76540;
        }
        .page a {
            float: left;
            width: 30px;
            height: 30px;
            margin-right: 5px;
            line-height: 30px;
            border-radius: 50%;
            text-align: center;
            text-align: center;
            font-size: 20px;
            font-family: "arial";
            color: #f76540;
        }
        .page ul li{
            float: left;
            width: 30px;
            height: 30px;
            margin-right: 5px;
            line-height: 30px;
            border-radius: 50%;
            text-align: center;
            text-align: center;
            font-size: 20px;
            font-family: "arial";

        }
        /*.page   a:link{*/
            /*color: #f7f5f3;*/
        /*}*/
        /*.page   a:visited{*/
        /*color: #FFFFFF;*/
        /*}*/
        /*.page   a:hover{*/
        /*color: #FFFFFF;*/
        /*}*/
        /*.page   a:active{*/
        /*color: #FFFFFF;*/
        /*}*/

        .cur {
            background: #f76540;
            color: #fff;
        }
        .cur a{
            color: #FFFFFF;
        }
    </style>
    <div class="page">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'nextPageLabel'=>'>',
            'activePageCssClass'=>'cur ',
            'options'=>['class'=>"",],
            'prevPageLabel'=>false,
//                'firstPageLabel'=>'1',
//                'lastPageLabel'=>'末页'
        ]); ?>
    </div>
</div>
<script id="layer_open" type="text/html">
    <div class="layer_open">
        <h3>职位名称： <%= title %></h3>
        <ul>
            <li>职位编码： <%= id %></li>
            <li>部门： <%= department %></li>
            <li>招聘对象： <%= obj %></li>
            <li>工作地区： <%= add %> </li>
            <li>招聘人数： <%= order %></li>
            <li>月薪： <%= money %></li>
            <li>发布日期： <%= date %> </li>
            <li>招聘类型： <%= type %> </li>
            <li>职能类别： <%= item %> </li>
        </ul>
        <dl>
            <dt>职位描述：</dt>
            <dd><%= intro %></dd>
        </dl>
        <div class="send">请把简历发送至： <%= email %></div>
        <div class="close"></div>
    </div>
</script>