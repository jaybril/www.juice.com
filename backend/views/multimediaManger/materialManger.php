<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\widgets\LinkPager;
                use common\widgets\Tool;
                use yii\widgets\Breadcrumbs;
                $admin_cur="material";
                $this->title='素材管理';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="material">
                <div class="material-head">
                    <?php $material_cur="index";
//                        echo   $this->render(\common\widgets\Variable::$layoutMaterialMenu_view);
                    ?>
                    <a  class="material-head-add">+添加素材分类</a>
                </div>
                <ul class="material-ul">
                    <?php
                        foreach($countries as $k=>$v){
                            echo '<li>';
                            echo '<div class="mater-li-head">'.Tool::echoEncodeString($v->name).'</div>';
                            echo '<div class="mater-li-ce">分类ID：'.Tool::echoEncodeString($v->id).'</div>';
                            echo ' <div class="mater-li-con">'.Tool::echoEncodeString($v->description).'</div>';
                            echo ' <div class="mater-a"><a onclick="deleteMaterialCat(this,'.Tool::echoEncodeString($v->id).')">删除</a></div>';
                            echo '</li>';
                        }
                    ?>
                </ul>
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
<div class="matered-fixed" id="matered-fixed">
    <div class="matered-close">×</div>
    <div class="matered-head">添加素材类别</div>
    <div class="matered-con">
        <form>
            <input type="text" placeholder="分类名称 如：首页banner图" id="materedCatName" />
            <textarea placeholder="描述 如：用于首页banner的展示图" id="description"></textarea>
            <label><input type="checkbox" class="mater-ch" id="isOnly" />是否唯一</label>
            <input type="button" onclick="addMateredCat()" value="提交保存" class="matered-btn" />
        </form>
    </div>
</div>
