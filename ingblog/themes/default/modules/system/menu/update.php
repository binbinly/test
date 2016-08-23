<?php
use yii\helpers\Html;
use app\assets\AppAsset;
$this->title = '更新菜单';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <div class="pull-left"><h5>更新菜单</h5></div>
            <div class="pull-right"><a class="btn btn-danger btn-xs" href="<?= \yii\helpers\Url::to(['/system/menu/index'])?>">返回</a></div>
        </div>
        <div class='ibox-content'>
            <div class="main-box-body clearfix">
                <form method="post" class="form form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">标题</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MenuService[title]" value="<?= $menu_info->title?>" style="width: 80%">
                            <span class="help-block">（用于后台显示的配置标题）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">菜单类型</label>
                        <div class="col-lg-10">
                            <select name="MenuService[type]" class="form-control" style="width: 50%">
                                <?foreach(Yii::$app->params['menuType'] as $item):?>
                                    <option value="<?= $item['id']?>" <? if($item['id'] == $menu_info->type):?>selected<?endif;?>><?= $item['name']?></option>
                                <? endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">小图标</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MenuService[icon]" value="<?= $menu_info->icon?>" style="width: 80%">
                            <span class="help-block">（用于显示在菜单左侧，不填则不显示）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">排序</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MenuService[sort]" value="<?= $menu_info->sort?>" style="width: 60%">
                            <span class="help-block">（用于分组显示的顺序）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">链接</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MenuService[url]" value="<?= $menu_info->url?>" style="width: 80%">
                            <span class="help-block">（U函数解析的URL或者外链）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">上级菜单</label>
                        <div class="col-lg-10">
                            <select name="MenuService[pid]" class="form-control" style="width: 50%">
                                <option value="0">顶级菜单</option>
                                <? foreach($menus as $item) :?>
                                <option value="<?= $item['id']?>" <? if($item['id'] == $menu_info->pid):?>selected<? endif;?>><?= $item['title_show']?></option>
                                <? endforeach;?>
                            </select>
                            <span class="help-block">（所属的上级菜单）</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">是否菜单</label>
                        <div class="col-lg-1">
                            <select name="MenuService[is_menu]" class="form-control">
                                <option value="1" <? if($menu_info->is_menu == 1):?>selected<? endif;?>>是</option>
                                <option value="0" <? if($menu_info->is_menu == 0):?>selected<? endif;?>>否</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">说明</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MenuService[tip]" value="<?= $menu_info->tip?>" style="width: 60%;">
                            <span class="help-block">（菜单详细说明）</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="hidden" name="MenuService[id]" value="<?= $menu_info->id?>"/>
                            <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="reset" class="btn btn-white">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
