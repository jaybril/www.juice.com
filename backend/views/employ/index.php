<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\GlobalArray;
            use common\widgets\Variable;
            use yii\widgets\LinkPager;
//            use unclead\widgets\MultipleInput;
            $admin_cur="employ";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='招聘管理';
            echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
                <div class="seller-head">
                    <a href="<?php echo Variable::$addEmploy_url;?>" class="seller-head-add">+添加招聘信息</a>
                </div>

                <div class="adminuser">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>职位名称</th>
                            <th>状态</th>
                            <th>招聘人数</th>
                            <th>面对群体</th>
                            <th>招聘性质</th>
                            <th>薪资</th>
                            <th>工作地区</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo '<tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->employName).'</td>';
                            echo '<td>'.GlobalArray::$employStatusArr[Tool::echoEncodeString($v->status,0)].'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->count).'</td>';
                            echo '<td>'.GlobalArray::$employGroupArr[Tool::echoEncodeString($v->group,'0')].'</td>';
                            echo '<td>'.GlobalArray::$employTypeArr[Tool::echoEncodeString($v->type,'0')].'</td>';
                            echo ' <td>'.Tool::echoEncodeString($v->money).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->address).'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editEmploy_url,'id'=>Tool::echoEncodeString($v->id)]).'">编辑</a><a onclick="deleteEmploy(this,'.Tool::echoEncodeString($v->id).')">删除</a></td>';
                            echo '</tr>';
                        }
                        ?>

                    </table>
                </div>
            </div>



<!--            <embed src="http://player.youku.com/player.php/Type/Folder/Fid/16980025/Ob/1/Pt/0/sid/XMzQ3Njg5MTAw/v.swf" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash"></embed>-->

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
