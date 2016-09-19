<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '更新广告位';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>更新广告位</h5>
        </div>
        <div class='ibox-content'>
            <?php $form = ActiveForm::begin([
                'id' => 'adPositionUpdate',
                'options' => ['class'=>'form-horizontal'],
                'enableAjaxValidation'=>false,
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ]
            ]);?>
            <?=$form->field($model,'position_id')->dropDownList(\app\modules\other\models\AdPosition::getAdPositionAll())?>
            <?=$form->field($model,'title')->textInput()?>
            <?=$form->field($upload_model,'editor_img')->fileInput()->label('图片')?>
            <? if($model->cover): ?>
            <div class="form-group">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"><img src="<?= \app\models\BaseService::getTypeFileUrl($model->cover, 'editorDir')?>"/></div>
            </div>
            <? endif; ?>
            <?=$form->field($model,'url')->textInput()?>
            <?=$form->field($model,'desc')->textarea()?>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="AdService[id]" value="<?= $model->id?>"/>
                    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="reset" class="btn btn-white">取消</button>
                </div>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>