<?php
/**
 * Created by PhpStorm.
 * User: tanbin2
 * Date: 2016/6/21
 * Time: 15:01
 */

namespace app\controllers;

use app\modules\system\models\Menu;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;

class BaseController extends Controller{

    public function returnAjax($code, $msg, $data = null, $expr = null) {
        $return['code'] = $code;
        $return['msg'] = $msg;
        if($data !== null) {
            $return['data'] = $data;
        }
        if($expr) {
            foreach($expr as $key=>$item) {
                $return[$key] = $item;
            }
        }
        exit(json_encode($return));
    }

    public static function formatNav(){
        $controllerName = Yii::$app->controller->id;
        $actionName = Yii::$app->controller->action->id;
        $moduleName = Yii::$app->controller->module->id;
        $url = '/'.$moduleName.'/'.$controllerName.'/'.$actionName;
        $menu = Menu::findOne(['url'=>$url]);

        if($menu && $menu->pid > 0) {
            $navStr = '<h2>'.$menu->title.'</h2><ol class="breadcrumb">';
            $navStr .= self::recursionNav($menu->id);
        }else{
            $navStr = '<h2>首页</h2><ol class="breadcrumb">';
            $navStr .= "<li><a href='".Url::to(['/'])."'>首页</a></li>";
        }
        $navStr .= '</ol>';
        echo $navStr;
    }

    private static function recursionNav($id){
        $navList = Menu::findOne($id);
        if($navList->pid == 0) return "<li><strong>".$navList->title."</strong></li>";
        return self::recursionNav($navList->pid) . "<li><a href='".Url::to([$navList->url])."'>".$navList->title."</a></li>";
    }

}