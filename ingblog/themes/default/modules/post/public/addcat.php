<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class='modal fade' id="add-cat-form" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="ibox-title"><h5>添加分类 <span id="level_name" style="font-size: 10px;">顶级分类</span></h5></div>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'id'=>'cat-form',
                    'options' => ['class'=>'form-horizontal'],
                    'enableAjaxValidation'=>false,
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ]
                ]);?>
                <?=$form->field($model,'name')->textInput()?>
                <?=$form->field($model,'description')->textArea()?>
                <?=$form->field($model,'sort')->textInput()?>
                <?=$form->field($model,'is_show')->inline()->radioList(['1'=>'是', '0'=>'否'])?>
                <input type="hidden" name="CatService[level]" value="1" id="level"/>
                <input type="hidden" name="CatService[parent_id]" value="0" id="parent_id"/>
                <input type="hidden" name="CatService[cat_id]" value="" id="cat_id"/>
                <?=Html::submitButton('send',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>
