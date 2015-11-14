<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets;
?>

	<div class="container">
		<div class="login">
			<div class="login-head">欢迎来到名坡绿茶，我们将竭诚为你服务。</div>
			<div class="login-con">
				<?php $form = ActiveForm::begin(['id' => 'login-form','options'=>['class'=>'login-form']]); ?>
					<?= $form->field($model, 'mobile')->textInput(['class' => 'login-text','placeholder'=>'手机号码/昵称'])->label('') ?>
					<?= $form->field($model,'password')->passwordInput(['class' => 'login-paw','placeholder'=>'密码'])->label('') ?>
					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(),[
						'template' => '<div>{image}{input}</div>',
						'imageOptions' => ['alt' => '验证码','class' => 'login-obtain'],
						'captchaAction' => 'site/captcha',
						'options'=>['class'=>'login-yzm','placeholder'=>'验证码'],
					])->label(''); ?>
					<?= Html::submitInput('登录', ['class' => 'login-btn', 'name' => 'login-button']) ?>
				<?php ActiveForm::end(); ?>
				<a href="<?php echo \common\widgets\FVariable::$siteForgetpsw_url?>" class="login-forget">忘记密码？</a>
				<div class="login-bottom">
					还没有账号？<a href="<?php echo \common\widgets\FVariable::$siteRegister_url?>">注册</a>
				</div>
			</div>
		</div>
	</div>
