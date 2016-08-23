<?php
namespace app\modules\system\controllers;

use app\controllers\UserBaseController;
use app\modules\system\models\Menu;
use app\modules\system\service\MenuService;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `system` module
 */
class MenuController extends UserBaseController
{
    public function actionIndex(){
        if(Yii::$app->request->isAjax) {
            //$offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');

            $config_list = Menu::getAdminMenuList();
            $config_count = Menu::getAdminMenuCount();

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $config_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $config_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }
        return $this->render('index');
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = new MenuService();
        if(Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->getSession()->setFlash('success','菜单保存成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '请完善参数');
            }
            return $this->refresh();
        }
        $menu_info = Menu::findOne($id);
        if($menu_info === null) {
            $menu_info = new Menu();
        }
        return $this->render('update', ['menu_info'=>$menu_info, 'menus'=>Menu::getAdminMenuList()]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        $menu_model = Menu::findOne($id);
        if($menu_model) {
            $succ = $menu_model->delete();
            if($succ) {
                $this->returnAjax(1, '删除成功!');
            }else{
                $this->returnAjax(-1, '删除失败!');
            }
        }else{
            $this->returnAjax(-2, '参数不合法!');
        }
    }
}