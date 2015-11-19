<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use yii\widgets\LinkPager;
            use common\widgets\Variable;
            use yii\helpers\Html;
            $admin_cur="brand";
            $this->title='品牌管理';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="member">
                <div class="member-head">
                    <div class="seller-head">
                        <a href="<?=Variable::$addBrand_url?>" class="seller-head-add">+添加品牌</a>
                    </div>
                </div>
                <div class="member-con articleM-con">
                    <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>品牌名称</th>
                            <th>所属客户分类</th>
                            <th>灰色logo</th>
                            <th>彩色logo</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo ' <tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->name).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->parent->name).'</td>';
                            echo '<td><a target="_blank" href="'.Tool::echoEncodeString($v->blogo).'"><img width="120" height="60" src="'.Tool::echoEncodeString($v->blogo).'"></a></td>';
                            echo '<td><a target="_blank" href="'.Tool::echoEncodeString($v->clogo).'"><img width="120" height="60" src="'.Tool::echoEncodeString($v->clogo).'"></a></td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([Variable::$editBrand_url,'id'=>Html::encode($v['id'])]).'"  >编辑</a><a onclick="deleteCus(this,'.Tool::echoEncodeString($v->id).')">删除</a></td>';
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
        </div>
    </div>
</div>