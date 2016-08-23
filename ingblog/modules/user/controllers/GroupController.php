<?php

namespace app\modules\user\controllers;

use app\controllers\UserBaseController;
use app\modules\user\models\UserGroup;
use app\modules\user\service\UserGroupService;
use Yii;

/**
 * Default controller for the `user` module
 */
class GroupController extends UserBaseController
{

    public function actionIndex(){
        if(Yii::$app->request->isAjax) {
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');

            $where = ['type'=>1];
            $config_list = UserGroup::getGroupList($where, $search['value'], $limit, $offset);
            $config_count = UserGroup::getGroupCount($where);

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $config_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $config_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }
        return $this->render('index');
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        $model = UserGroup::findOne($id);
        if($model) {
            $succ = $model->delete();
            if($succ) {
                UserGroup::delAccess($id);
                $this->returnAjax(1, '删除成功!');
            }else{
                $this->returnAjax(-1, '删除失败!');
            }
        }else{
            $this->returnAjax(-2, '参数不合法!');
        }
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = new UserGroupService();
        if(Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->getSession()->setFlash('success','用户组保存成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '请完善参数');
            }
            return $this->refresh();
        }
        if($id) {
            $model->loadGroup($id);
        }
        return $this->render('update', ['model'=>$model]);
    }

    public function actionAccess(){
        $gid = Yii::$app->request->get('id');
        $model = new UserGroup();
        if(Yii::$app->request->isPost) {
            if ($model->access($gid)) {
                Yii::$app->getSession()->setFlash('success','授权成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '请完善参数');
            }
            return $this->refresh();
        }
        $access_list = [];
        if($gid) {
            $access_list = $model->getAccess($gid);
        }
        return $this->render('access', ['access_list'=>$access_list]);
    }
}