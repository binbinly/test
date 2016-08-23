<?php

namespace app\modules\system\controllers;

use app\controllers\UserBaseController;
use app\modules\system\models\Config;
use app\modules\system\service\ConfigService;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `system` module
 */
class ConfigController extends UserBaseController
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $list = Config::configAll();
        $model = new Config();
        if (Yii::$app->request->isPost && $model->saveConfig()){
            Yii::$app->getSession()->setFlash('success','配置保存成功');
            return $this->refresh();
        }
        return $this->render('index', ['configList'=>$list, 'configType'=>Yii::$app->params['configType']]);
    }

    public function actionList() {
        if(Yii::$app->request->isAjax) {
            $model = new Config();
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');
            $group = Yii::$app->request->post('group');

            $where['status'] = 1;
            if($group) {
                $where['group'] = $group;
            }
            $config_list = $this->format($model->configList($limit, $offset, $search['value'], $where));
            $config_count = $model->configAllCount();

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $config_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $config_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }
        return $this->render('list');
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('config_id');
        $config_model = Config::findOne($id);
        if($config_model) {
            $config_model->status = 0;
            $succ = $config_model->save();
            if($succ) {
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
        $model = new ConfigService();
        if(Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->getSession()->setFlash('success','配置保存成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '请完善参数');
            }
            return $this->refresh();
        }
        $config_info = Config::findOne($id);
        if($config_info === null) {
            $config_info = new Config();
        }
        return $this->render('update', ['config_info'=>$config_info]);
    }

    public static function formatString($string){
        $array = explode(',', $string);
        $return = [];
        foreach($array as $key=>$val) {
            $array_val = explode(':', $val);
            $return[$key]['key'] = $array_val[0];
            $return[$key]['value'] = $array_val[1];
        }
        return $return ;
    }

    public function format($list){
        $configType = Yii::$app->params['configType'];
        $configValueType = Yii::$app->params['configValueType'];
        foreach($list as &$item) {
            $item['group'] = $configType[$item['group']]['title'];
            $item['type'] = $configValueType[$item['type']]['title'];
        }
        return $list;
    }
}
