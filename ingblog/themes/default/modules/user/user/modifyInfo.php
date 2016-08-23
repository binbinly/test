<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;
use app\modules\user\models\District;

//use kartik\date\DatePicker;
$this->title = '修改个人信息';
?>
<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>更新个人信息</h5>
        </div>
        <div class='ibox-content'>
            <?php $form = ActiveForm::begin([
                'id' => 'modifyInfoForm',
                'options' => ['class'=>'form-horizontal'],
                'enableAjaxValidation'=>false,
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-2 control-label'],
                ]
            ]);?>
                <? if($model->uid){ ?>
                <?=$form->field($model,'user_login')->textInput(['disabled'=>''])?>
                <? }else{ ?>
                <?=$form->field($model,'user_login')->textInput()?>
                <? } ?>
                <?=$form->field($model,'user_email')->textInput()?>
                <? if(!$model->uid): ?>
                <?=$form->field($model,'password')->passwordInput()?>
                <?=$form->field($model,'password_repeat')->passwordInput()?>
                <? endif; ?>
                <?=$form->field($model,'gender')->inline()->radioList(Yii::$app->params['gender'])?>
                <?=$form->field($model,'qq')->textInput()?>
                <? if(\app\modules\user\models\User::getUser()->group_id == Yii::$app->params['adminId']):?>
                <?=$form->field($model,'group_id')->dropDownList(\app\modules\user\models\UserGroup::getGroupAll())?>
                <? endif; ?>
            <?= $form->field($model, 'location', [
                'template'=>'{label}<div id="area_linkage"><div class="col-sm-2">'.
                    Html::activeDropDownList($model->_info,'province_area_id', ArrayHelper::map(District::getChildrenList(0,1), 'id', 'name'), [
                        'class' => 'form-control',
                        'onchange' => '
                                $("#userinfoservice-location").val($(this).val());
                                $.ajax({
                                    type:"post",
                                    url:"'.Yii::$app->urlManager->createUrl('/user/user/ajax-post-children-area').'",
                                    data:{pid:$(this).val(),level:2},
                                    success:function(msg){
                                        $("#userinfo-city_area_id").html(msg);
                                        $("#userinfo-county_area_id").html(\' <option value = "0" > 请选择区</option> \');
                                        $("#userinfo-town_area_id").html(\' <option value = "0" > 请选择镇</option> \');
                                    }
                                });
                            ',
                    ])
                    .'</div><div class="col-sm-2">'.
                    Html::activeDropDownList($model->_info,'city_area_id', ArrayHelper::map(District::getChildrenList($model->_info->province_area_id,2), 'id', 'name'), [
                        'class' => 'form-control',
                        'onchange' => '
                                $("#userinfoservice-location").val($(this).val());
                                $.ajax({
                                    type:"post",
                                    url:"'.Yii::$app->urlManager->createUrl('/user/user/ajax-post-children-area').'",
                                    data:{pid:$(this).val(),level:3},
                                    success:function(msg){
                                        $("#userinfo-county_area_id").html(msg);
                                        $("#userinfo-town_area_id").html(\' <option value = "0" > 请选择镇</option> \');
                                    }
                                });
                            ',
                    ])
                    .'</div><div class="col-sm-2">'.
                    Html::activeDropDownList($model->_info,'county_area_id', ArrayHelper::map(District::getChildrenList($model->_info->city_area_id,3), 'id', 'name'), [
                        'class' => 'form-control',
                        'onchange' => '
                                $("#userinfoservice-location").val($(this).val());
                                $.ajax({
                                    type:"post",
                                    url:"'.Yii::$app->urlManager->createUrl('/user/user/ajax-post-children-area').'",
                                    data:{pid:$(this).val(),level:4},
                                    success:function(msg){
                                        $("#userinfo-town_area_id").html(msg);
                                    }
                                });
                            ',
                    ])
                    .'</div><div class="col-sm-2">'.
                    Html::activeDropDownList($model->_info,'town_area_id', ArrayHelper::map(District::getChildrenList($model->_info->county_area_id,4), 'id', 'name'), [
                        'class' => 'form-control',
                        'onchange' => '
                            $("#userinfoservice-location").val($(this).val());
                        ',
                    ])
                    .'</div><div class="hidden" id="parent_div_area_id">{input}</div></div>',
            ])->hiddenInput(); ?>
                <?=$form->field($model,'nickname')->textInput()?>
                <?=$form->field($model,'birthday')->textInput(['class'=>'form-control Wdate','onclick'=>'WdatePicker()','readonly'=>''])?>
                <?=$form->field($model,'signature')->textarea()?>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <input type="hidden" name="UserInfoService[uid]" value="<?= $model->uid;?>">
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="reset" class="btn btn-white">取消</button>
                </div>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>
<? AppAsset::addCss($this,'@web/plugins/My97DatePicker/skin/WdatePicker.css'); ?>
<? //AppAsset::addCss($this,'@web/css/plugins/chosen/chosen.css'); ?>
<? AppAsset::addScript($this,'@web/plugins/My97DatePicker/WdatePicker.js'); ?>
<? //AppAsset::addScript($this,'@web/js/plugins/chosen/chosen.jquery.js'); ?>
<!--<script type="text/javascript">-->
<!--    $(function(){-->
<!--        var config = {-->
<!--            '.chosen-select': {},-->
<!--            '.chosen-select-deselect': {-->
<!--                allow_single_deselect: true-->
<!--            },-->
<!--            '.chosen-select-no-single': {-->
<!--                disable_search_threshold: 10-->
<!--            },-->
<!--            '.chosen-select-no-results': {-->
<!--                no_results_text: 'Oops, nothing found!'-->
<!--            },-->
<!--            '.chosen-select-width': {-->
<!--                width: "95%"-->
<!--            }-->
<!--        }-->
<!--        function selector_init() {-->
<!--            for (var selector in config) {-->
<!--                $(selector).chosen(config[selector]);-->
<!--            }-->
<!--        }-->
<!--    });-->
<!--</script>-->
