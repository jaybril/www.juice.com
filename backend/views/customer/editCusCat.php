<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\Variable;
            use unclead\widgets\MultipleInput;
            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            $admin_cur="customer";
            $this->title='编辑客户分类';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['客户分类管理',Variable::$customerIndex_url],[$this->title]]) ?>
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
                </div>
                <div id="barform-name" class="multiple-input">
                    <table class="multiple-input-list table table-condensed" id="rowTable">
                        <thead>
                        <tr><th class="list-cell__user_id">分类名</th>
                            <th class="list-cell__priority">展示顺序</th>
                            <th class="list-cell__button"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if($catModel){
                            foreach($catModel as $k=>$v){
                                echo '<input type="hidden" value="'.$v->id.'" id="barId">';
                                echo'<tr class="list__item">';
                                echo'<td class="list_name">';
                                echo'<div class="form-group">';
                                echo'<input type="text" class="input-priority col-lg-3 form-control barName" value="'.$v->name.'">';
                                echo'</div>';
                                echo'</td>';
                                echo' <td class="list_link">';
                                echo'<div class="form-group">';
                                echo'<input type="text"  class="input-priority form-control barLink" value="'.$v->sort.'">';
                                echo'<div class="help-block help-block-error">';
                                echo'</div>';
                                echo' </div>';
                                echo'</td>';
                                echo'<td>';
                                echo'<div class="btn btn btn-success" onclick="updateOnRowForCus(this,'.$v->id.')">更新</div>';
                                echo'<div class="btn btn btn-cancel" style="margin-left: 4px;" onclick="deleteOnRowForCus(this,'.$v->id.')">删除</div>';
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
                    <button type="button" class="btn  btn-success col-lg-2 col-lg-offset-2" onclick="addOnRowForCus(0)">添加一个客户分类</button>
                    <a class="btn-cancel col-lg-2 col-lg-offset-1" href="<?php echo \common\widgets\Variable::$customerIndex_url ;?>">返回</a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>