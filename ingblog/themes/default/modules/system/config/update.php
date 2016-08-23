<?php
use yii\helpers\Html;
use app\assets\AppAsset;
$this->title = '添加列表';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>添加配置</h5>
        </div>
        <div class='ibox-content'>
            <div class="main-box-body clearfix">
                <form method="post" class="form form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置标识</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="ConfigService[name]" value="<?= $config_info->name?>" <? if($config_info->id): ?>disabled=""<? endif;?>>
                            <span class="help-block">（用于config函数调用，只能使用英文且不能重复）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置标题</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="ConfigService[title]" value="<?= $config_info->title?>">
                            <span class="help-block">（用于后台显示的配置标题）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">排序</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="ConfigService[sort]" value="<?= $config_info->sort?>">
                            <span class="help-block">（用于分组显示的顺序）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置类型</label>
                        <div class="col-lg-8">
                            <select name="ConfigService[type]" class="form-control">
                                <option value="">请选择</option>
                                <? foreach(Yii::$app->params['configValueType'] as $key => $item): ?>
                                <option value="<?= $key?>" <? if($key == $config_info->type): ?>selected<? endif;?> ><?= $item['name']?>-<?= $item['title']?></option>
                                <? endforeach;?>
                            </select>
                            <span class="help-block">（系统会根据不同类型解析配置值）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置分组</label>
                        <div class="col-lg-8">
                            <select name="ConfigService[group]" class="form-control">
                                <option value="0">请选择</option>
                                <? foreach(Yii::$app->params['configType'] as $key => $item): ?>
                                <option value="<?= $key?>" <? if($key == $config_info->group): ?>selected<? endif;?>><?= $item['title']?></option>
                                <? endforeach;?>
                            </select>
                            <span class="help-block">（配置分组 用于批量设置 不分组则不会显示在系统设置中）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置值</label>
                        <div class="col-lg-8">
                            <textarea name="ConfigService[value]" class="form-control"><?= $config_info->value?></textarea>
                            <span class="help-block">（配置值）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">配置项</label>
                        <div class="col-lg-8">
                            <textarea name="ConfigService[extra]" class="form-control"><?= $config_info->extra?></textarea>
                            <span class="help-block">（如果是枚举型 需要配置该项）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">说明</label>
                        <div class="col-lg-10">
                            <textarea name="ConfigService[remark]" class="form-control" style="width: 80%;height: 120px"><?= $config_info->remark?></textarea>
                            <span class="help-block">（配置详细说明）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" value="<?= $config_info->id?>" name="ConfigService[id]" />
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-white">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
