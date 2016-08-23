<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
?>
<? AppAsset::addCss($this,'@web/css/login.css'); ?>
<div class="wrapper">

	<div class="container">
		<h1 class="text">Welcome</h1>
		<?php $form = ActiveForm::begin(['id'=>'loginForm']);?>
		<?=$form->field($model,'username')->textInput(['placeholder'=>$model->getAttributeLabel('username')])?>
		<?=$form->field($model,'password')->passwordInput(['placeholder'=>$model->getAttributeLabel('password')])?>
		<?=$form->field($model,'rememberMe')->checkbox(['template'=>
			"<div class=\"checkbox\">\n".
			"{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"])?>
		<?=Html::submitButton('登录',['class'=>'btn btn-block btn-primary'])?>
		<?php ActiveForm::end();?>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	
</div>