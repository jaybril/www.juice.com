
    <div class="container adminIndex">
<!--			--><?php //include('adminhead.php'); ?>

<div class="adminIndex-con">
    <div class="adminCon-left">
        <?php
            use common\widgets\Tool;
            use common\widgets\GlobalArray;
            use common\widgets\Variable;
            use yii\widgets\LinkPager;
            $admin_cur="national";
        ?>
        <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
    </div>
    <div class="adminCon-right">
        <?php
            $this->title='全国区域列表';
            echo  Tool::setBreadcrumbs([[$this->title]]);

        ?>
        <div class="seller">
<!--            <div class="seller-head"></div>-->
            <div class="national">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr class="table_body_head">
                        <th>序号</th>
                        <th>区域名称</th>
                        <th>上一级名称</th>
                        <th>状态</th>
                    </tr>
                    <?php
                        foreach($countries as $k=>$v){
                            $province='无';
                            if(isset($v->prev)){
                                $province=$v->prev->name;
                            }
                            echo '<tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->name).'</td>';
                            echo '<td>'.Tool::echoEncodeString($province ,'无').'</td>';
                            echo '<td>可用</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'nextPageLabel'=>'下一页',
            'prevPageLabel'=>'上一页',
            'firstPageLabel'=>'首页',
            'lastPageLabel'=>'末页'
        ]); ?>
<!--        <ul class="adminpage">-->
<!--            <li class="adminpage-first"><a href=""><img src="img/u107.png" /></a></li>-->
<!--            <li class="adminpage-prev"><a href=""><img src="img/u105.png" /></a></li>-->
<!--            <li><a href="">1</a></li>-->
<!--            <li class="active"><a href="">2</a></li>-->
<!--            <li class="adminpage-point"><a href="">...</a></li>-->
<!--            <li><a href="">45</a></li>-->
<!--            <li><a href="">46</a></li>-->
<!--            <li class="adminpage-next"><a href=""><img src="img/u111.png" /></a></li>-->
<!--            <li class="adminpage-last"><a href=""><img src="img/u109.png" /></a></li>-->
<!--            <li class="adminpage-search"><input type="text" /><a href="">GO</a></li>-->
<!--        </ul>-->
    </div>
</div>
</div>