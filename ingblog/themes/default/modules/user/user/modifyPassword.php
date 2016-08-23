<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '修改密码';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>修改密码</h5>
        </div>
        <div class='ibox-content'>
            <?php $form = ActiveForm::begin([
                'id' => 'modifyPasswordForm',
                'options' => ['class'=>'form-horizontal'],
                'enableAjaxValidation'=>false,
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ]
            ]);?>
                <?=$form->field($model,'old_password')->passwordInput()?>
                <?=$form->field($model,'new_password')->passwordInput()?>
                <?=$form->field($model,'renew_password')->passwordInput()?>
                <?=Html::submitButton('修改',['class'=>'btn btn-primary'])?>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>