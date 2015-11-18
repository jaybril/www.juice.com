<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\Variable;
            use unclead\widgets\MultipleInput;
            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            $admin_cur="bar";
            $this->title='编辑导航栏';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['底部导航栏',Variable::$barIndex_url],[$this->title]]) ?>
            <div class="member">
                <style>
                    .top{
                        font-size: 2rem;
                        border: solid 1px #FAFAFA;
                        margin: 6px;
                        text-align: left;
                        background: #FAFAFA;
                        line-height: 4rem;
                    }
                </style>
                <div class="row top">
                    <div>
                        <input type="hidden" value="<?=$barModel->id;?>" id="parentId">
                        <b style="color: #939090;">栏目名：</b>
                        <b><?=$barModel->name ;?></b>
                    </div>
                </div>
                <div id="barform-name" class="multiple-input">
                    <table class="multiple-input-list table table-condensed" id="rowTable">
                        <thead>
                        <tr><th class="list-cell__user_id">子栏目名</th>
                            <th class="list-cell__priority">链接地址</th>
                            <th class="list-cell__button"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if($barListModel){
                            foreach($barListModel as $k=>$v){
                              echo '<input type="hidden" value="'.$v->id.'" id="barId">';
                                echo'<tr class="list__item">';
                                echo'<td class="list_name">';
                                echo'<div class="form-group">';
                                echo'<input type="text" class="input-priority col-lg-3 form-control barName" value="'.$v->name.'">';
                                echo'</div>';
                                echo'</td>';
                                echo' <td class="list_link">';
                                echo'<div class="form-group">';
                                echo'<input type="text"  class="input-priority form-control barLink" value="'.$v->link.'">';
                                echo'<div class="help-block help-block-error">';
                                echo'</div>';
                                echo' </div>';
                                echo'</td>';
                                echo'<td>';
                                echo'<div class="btn btn btn-success" onclick="updateOnRow(this,'.$v->id.')">更新</div>';
                                echo'<div class="btn btn btn-cancel" style="margin-left: 4px;" onclick="deleteOnRow(this,'.$v->id.')">删除</div>';
                                echo'</td>';
                                echo'</tr>';
                                echo'';
                                echo'';
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button type="button" class="btn  btn-success col-lg-2 col-lg-offset-2" onclick="addOnRow()">添加一个子栏目</button>
                    <a class="btn-cancel col-lg-2 col-lg-offset-1" href="<?php echo \common\widgets\Variable::$barIndex_url ;?>">返回</a>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>