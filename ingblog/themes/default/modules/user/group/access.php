<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '用户组授权';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>用户组授权</h5>
        </div>
        <div class='ibox-content'>
            <form action="" class="form" method="post">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-lg-2 text-right">菜单</th>
                        <th>权限</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach(\app\modules\system\models\Menu::getAdminMenuList('tier', ['type'=>1]) as $item):?>
                    <tr>
                        <td class="info col-lg-2 text-right">
                            <input type="checkbox" name="access[]" value="<?= $item['id']?>" <? if(in_array($item['id'], $access_list)): ?>checked<? endif; ?> /> <?= $item['title']?></td>
                        <td class="col-lg-10 text-left">
                            <? if (isset($item['_child']) && is_array($item['_child'])): ?>
                            <? foreach($item['_child'] as $child): ?>
                            <div class="checkbox-nice checkbox-inline">
                                <input type="checkbox" name="access[]" value="<?= $child['id']?>" <? if(in_array($child['id'], $access_list)): ?>checked<? endif; ?> />
                                <label ><?= $child['title']?></label>
                            </div>
                            <? endforeach; endif; ?>
                        </td>
                    </tr>
                    <? endforeach;?>
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <input type="hidden" name="id" value=""/>
                        <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="reset" class="btn btn-white">取消</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>