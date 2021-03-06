<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '添加用户组';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>添加用户组</h5>
        </div>
        <div class='ibox-content'>
            <?php $form = ActiveForm::begin([
                'id' => 'linkUpdate',
                'options' => ['class'=>'form-horizontal'],
                'enableAjaxValidation'=>false,
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ]
            ]);?>
            <?=$form->field($model,'title')->textInput()?>
            <?=$form->field($model,'description')->textarea()?>
            <?=$form->field($model,'status')->dropDownList([ '1'=>'启用','0'=>'禁用'])?>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="UserGroupService[id]" value="<?= $model->id?>"/>
                    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="reset" class="btn btn-white">取消</button>
                </div>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>