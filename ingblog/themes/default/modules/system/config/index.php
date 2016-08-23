<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\system\controllers\ConfigController;
$this->title = '配置管理';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>配置管理</h5>
        </div>
        <div class='ibox-content'>
            <div class="panel-options">
                <ul class="nav nav-tabs">
                    <? foreach($configType as $key=>$item): ?>
                    <? if($key == 1):?>
                    <li class="active"><a href="#<?= $item['name']?>" data-toggle="tab" aria-expanded="true"><?= $item['title']?></a></li>
                    <? else: ?>
                    <li><a href="#<?= $item['name']?>" data-toggle="tab" aria-expanded="false"><?= $item['title']?></a></li>
                    <? endif;?>
                    <? endforeach;?>
                </ul>
            </div>
            <form class="form-horizontal" method="post">
            <div class="panel-body">
                <div class="tab-content">
                    <? foreach($configType as $key=>$val): ?>
                    <div id="<?= $val['name']?>" class="tab-pane <? if($key == 1):?>active<? endif;?>">
                            <? foreach($configList as $item) : ?>
                            <? if($val['id'] == $item['group']):?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $item['title'];?></label>
                                <div class="col-sm-8">
                                    <? switch($item['type']){
                                    case 'text': ?>
                                    <input type="text" class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" value="<?= $item['value']?>" placeholder="<?= $item['title']?>" style="width:50%;">
                                    <? break; ?>
                                    <? case 'num':?>
                                    <input type="text" class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" value="<?= $item['value']?>" placeholder="<?= $item['title']?>" style="width:50%;">
                                    <? break; ?>
                                    <? case 'string':?>
                                    <input type="text" class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" value="<?= $item['value']?>" placeholder="<?= $item['title']?>" style="width:50%;">
                                    <? break; ?>
                                    <? case 'textarea':?>
                                    <textarea class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" style="width:80%; height:120px;"><?= $item['value']?></textarea>
                                    <? break; ?>
                                    <? case 'select':?>
                                    <select class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" style="width:auto;">
                                        <? foreach(ConfigController::formatString($item['extra']) as $vo):?>
                                        <option value="<?= $vo['key']?>" <? if($vo['key'] == $item['value']):?>selected<? endif;?>><?= $vo['value']?></option>
                                        <? endforeach;?>
                                    </select>
                                    <? break; ?>
                                    <? case 'bool':?>
                                    <select class="form-control" name="<?= $item['name']?>" id="<?= $item['name']?>" style="width:auto;">
                                        <? foreach(ConfigController::formatString($item['extra']) as $vo):?>
                                            <option value="<?= $vo['key']?>" <? if($vo['key'] == $item['value']):?>selected<? endif;?>><?= $vo['value']?></option>
                                        <? endforeach;?>
                                    </select>
                                    <? }?>
                                        <span class="help-block m-b-none"><?= $item['remark']?></span>
                                </div>
                            </div>
                            <? endif;?>
                            <? endforeach;?>
                    </div>
                    <? endforeach;?>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-white">取消</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>