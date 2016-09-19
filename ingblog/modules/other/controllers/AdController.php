<?php

namespace app\modules\other\controllers;

use app\controllers\UserBaseController;
use app\models\UploadService;
use app\modules\other\models\Ad;
use app\modules\other\service\AdService;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

/**
 * Default controller for the `other` module
 */
class AdController extends UserBaseController
{

    public function actionIndex()
    {
        if(Yii::$app->request->isAjax) {
            $model = new Ad();
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');
            $order = Yii::$app->request->post('order');
            $columns = Yii::$app->request->post('columns');

            //排序
            $orderBy = null;
            foreach($order as $o) {
                $orderBy[$columns[$o['column']]['data']] = $o['dir'] == 'asc' ? SORT_ASC : SORT_DESC;
            }

            $list = $model->getAdList($search['value'], $orderBy, $limit, $offset);
            $count = $model->getAdCount();

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);
        }else{
            return $this->render('index');
        }
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        $model = new AdService();
        $upload_model = new UploadService();

        if(Yii::$app->request->isPost) {
            //if has cover_url
            if($_FILES) {
                $upload_model->scenario = 'editor';
                if (Yii::$app->request->isPost) {
                    $upload_model->editor_img = UploadedFile::getInstance($upload_model, 'editor_img');
                    if ($upload_model->uploadEditorImage()) {
                        $model->cover = $upload_model->editor_img;
                    }
                }
            }

            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->getSession()->setFlash('success','广告保存成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '请完善参数');
            }
            return $this->render('update', ['model'=>$model, 'upload_model'=>$upload_model]);
        }else{
            if($id) {
                $model->loadInfo($id);
            }
        }
        return $this->render('update', ['model'=>$model, 'upload_model'=>$upload_model]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        $model = Ad::findOne($id);
        if($model) {
            $succ = $model->delete();
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
