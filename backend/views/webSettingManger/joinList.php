<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\GlobalArray;
            use common\widgets\Variable;
            use yii\widgets\LinkPager;
            $admin_cur="join";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='加盟申请列表';
            echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
<!--                <div class="seller-head">-->
<!--                    <a href="--><?php //echo Variable::$addAdminUser_url;?><!--" class="seller-head-add">+添加管理员</a>-->
<!--                </div>-->

                <div class="adminuser">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr class="table_body_head">
                            <th>申请人</th>
                            <th>手机号码</th>
                            <th>邮箱</th>
                            <th>公司名称</th>
                            <th>企业性质</th>
                            <th>行业</th>
                            <th>申请时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo '<tr>';
//                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->username).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->mobile,'无').'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->email,'无').'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->company,'无').'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->nature,'无').'</td>';
                            echo ' <td>'.Tool::echoEncodeString($v->industry,'无').'</td>';
                            echo ' <td>'.Tool::echoEncodeString($v->applyTime,'无').'</td>';
                            echo '<td>'.GlobalArray::$jionStatusArr[Tool::echoEncodeString($v->status,0)].'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editJoin_url,'id'=>Tool::echoEncodeString($v->id)]).'">编辑</a></td>';
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

<div class="discount-fixed seller-fixed" id="seller-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">添加管理员</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="用户名" />
            <input type="password" placeholder="密码" />
            <input type="text" placeholder="手机号码" />
            <input type="text" placeholder="角色" />
            <input type="submit" value="确定" class="dis-btn" />
        </form>
    </div>
</div>