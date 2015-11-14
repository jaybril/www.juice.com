<div class="container adminIndex">
<?php
    use yii\widgets\LinkPager;
    use common\widgets\Variable;
    use common\widgets\GlobalArray;
    use common\widgets\Tool;
?>
<div class="adminIndex-con">
    <div class="adminCon-left">
        <?php
            $admin_cur="order";
            $this->title='订单管理';
        ?>
        <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
    </div>
    <div class="adminCon-right" >
        <?= Tool::setBreadcrumbs([[$this->title]]) ?>
        <div class="member">
<!--            <div class="member-head">-->
<!--							<span class="meber-span">订单状态-->
<!--								<select>-->
<!--                                    <option>全部</option>-->
<!--                                    <option>待支付</option>-->
<!--                                    <option>待发货</option>-->
<!--                                    <option>已发货</option>-->
<!--                                    <option>已完成</option>-->
<!--                                    <option>已取消</option>-->
<!--                                </select>-->
<!--							</span>-->
<!--                <form>-->
<!--                    <input type="text" class="member-form-text" placeholder="下单人（昵称）" />-->
<!--                    <input type="text" class="member-form-text" placeholder="订单日期" />-->
<!--                    <input type="text" class="member-form-text" placeholder="订单号" />-->
<!--                    <input type="submit" value="查询" class="member-form-btn" />-->
<!--                </form>-->
<!--            </div>-->
            <div class="member-con orderM-con">
                <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                    <tr class="table_body_head">
                        <th>序号</th>
                        <th>订单号</th>
                        <th>订单日期</th>
                        <th>订单状态</th>
                        <th>下单人（昵称）</th>
                        <th>订单金额</th>
                        <th>操作</th>
                    </tr>
                    <?php
                        foreach($countries as $k=>$v){
                            $sendStr='详情';
                            $class='btn3';
                            if($v->orderStatus==1){
                                $sendStr='发货';
                                $class='btn1';
                            }
                            echo ' <tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->orderNo).'</td>';
                            echo '<td>'.Tool::echoEncodeString(date('y-m-d:H:i',strtotime($v->orderTime))).'</td>';
                            echo '<td>'.GlobalArray::$orderStatusArray[Tool::echoEncodeString($v->orderStatus,'0')].'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->user->nickName).'</td>';
                            echo '<td>￥'.Tool::echoEncodeString($v->orderMoney).'</td>';
                            echo '<td>';
                            echo '<a href="'.Yii::$app->urlManager->createUrl([Variable::$deliverOrder_url,'id'=>Tool::echoEncodeString($v->id)]).'" class='.$class.'>'.$sendStr.'</a>';
                            echo '<a href="'.Yii::$app->urlManager->createUrl([Variable::$editOrder_url,'id'=>Tool::echoEncodeString($v->id)]).'" class="among btn2">编辑</a>';
                            echo '</td>';
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

<div class="discount-fixed order-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">添加物流信息</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="物流公司" />
            <input type="text" placeholder="货运单号" />
            <input type="submit" value="确定" class="dis-btn" />
        </form>
    </div>
</div>