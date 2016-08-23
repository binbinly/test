<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '添加友情链接';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>添加友情链接</h5>
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
            <?=$form->field($model,'url')->textInput()?>
            <?=$form->field($upload_model,'editor_img')->fileInput()?>
            <?=$form->field($model,'sort')->textInput()?>
            <?=$form->field($model,'descrip')->textInput()?>
            <?=$form->field($model,'status')->dropDownList([ '1'=>'启用','0'=>'禁用'])?>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="LinkService[id]" value="<?= $model->id?>"/>
                    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="reset" class="btn btn-white">取消</button>
                </div>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>