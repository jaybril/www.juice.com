<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\Tool;
            use yii\web;
            use yii\base;
            use kucha\ueditor\UEditor;
            $admin_cur="video";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='视频管理';
            echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="row dis-con">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">添加网络链接</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">本地上传</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div id="barform-name" class="multiple-input">
                                    <table class="multiple-input-list table table-condensed" id="rowTable">
                                        <thead>
                                        <tr><th class="list-cell__user_id">网络链接</th>
                                            <th class="list-cell__button"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <input type="hidden" value="1020" id="barId">
                                        <tr class="list__item">
                                            <td class="list_name">
                                                <div class="form-group">
                                                    <input type="text" class="input-priority col-lg-3 form-control barName" value="edwdw">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn btn btn-success" onclick="updateOnRowForCus(this,1020)">确定</div>
<!--                                                <div class="btn btn btn-cancel" style="margin-left: 4px;" onclick="deleteOnRowForCus(this,1020)">删除</div>-->
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <form>
                                    <input id="projectfile" name="file" type="file" />
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
<!--                    <object type="application/x-shockwave-flash" data="--><?//=$video->address?><!--" width="100%" height="300px">-->
<!--                        <param name="allowFullScreen" value="true">-->
<!--                        <param name="allowScriptAccess" value="always">-->
<!--                        <param name="movie" value="--><?//=$video->address?><!--">-->
<!--                        <param name="flashvars" value="imglogo=&amp;paid=0&amp;partnerId=localhost">-->
<!--                    </object>-->
                    <video width="400" height="240" controls >
                        <source src="<?=$video->address?>" type="video/ogg" width="300px">
<!--                        <source src="movie.mp4" type="video/mp4">-->
<!--                        <source src="movie.webm" type="video/webm">-->
<!--                        <object data="movie.mp4" width="320" height="240">-->
<!--                            <embed width="320" height="240" src="movie.swf">-->
                        </object>
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('myjs') ?>

$(function() {
$('#projectfile').uploadify({
'swf'      : '/uploadify/uploadify.swf',
'uploader' : '/websettingmanger/uploadvideo',
'formData': {'projectid': '${project.id}'},
'fileObjName' : 'file',
'fileSizeLimit' : '0',
'onQueueComplete' : function(queueData) {
alert('文件上传成功');
LocationPageByTimeOut('', 1);
}
});
});
<?php $this->endBlock() ?>

<?php $this->registerJs($this->blocks['myjs'], \yii\web\View::POS_END); ?>