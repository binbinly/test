<?php

namespace app\modules\post\controllers;

use app\controllers\UserBaseController;
use app\modules\post\service\CatService;
use Yii;
use app\modules\post\models\Cat;
use app\modules\post\models\CatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatController implements the CRUD actions for Cat model.
 */
class CatController extends UserBaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cat = new CatService();
        if(Yii::$app->request->isAjax) {
            $model = new Cat();
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');
            $order = Yii::$app->request->post('order');
            $columns = Yii::$app->request->post('columns');
            $parent_id = Yii::$app->request->post("parent_id");

            //排序
            $orderBy = null;
            foreach($order as $o) {
                $orderBy[$columns[$o['column']]['data']] = $o['dir'] == 'asc' ? SORT_ASC : SORT_DESC;
            }

            $where = ['parent_id'=>0];
            if($parent_id) {
                $where['parent_id'] = $parent_id;
            }
            $cat_list = $model->getCatAll($where, $search['value'], $orderBy, $limit, $offset);
            $cat_count = $model->getCatAllCount($where);

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $cat_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $cat_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }else if (Yii::$app->request->isPost) {
            if ($cat->load(Yii::$app->request->post()) && $cat->addCat()) {
                Yii::$app->getSession()->setFlash('success', '添加分类成功');
            }else{
                Yii::$app->getSession()->setFlash('error', '添加分类失败');
            }
            return $this->refresh();
        }
        return $this->render('index', ['model'=>$cat]);
    }

    /**
     * Deletes an existing Cat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {   $id = Yii::$app->request->post('cat_id');

        $is_child = Cat::findOne(['parent_id'=>$id]);
        if($is_child) {
            Yii::$app->getSession()->setFlash('error','该分类下存在子分类,无法删除哦!');
        }else{
            $succ = $this->findModel($id)->delete();
            if($succ) {
                Yii::$app->getSession()->setFlash('success','删除成功!');
            }else{
                Yii::$app->getSession()->setFlash('error','删除失败!');
            }
        }

        return $this->redirect(['index']);
    }

    public function actionIsShow() {
        $id = Yii::$app->request->post('cat_id');
        $is_show = Yii::$app->request->post('is_show');
        $model = $this->findModel($id);
        $model->is_show = $is_show;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionAjaxAddCat() {
        $name = Yii::$app->request->post('name');
        $parent_id = Yii::$app->request->post('parent_id');
        $cat = new Cat();
        $id = $cat->addCat($name, $parent_id);
        if($id) {
            $this->returnAjax(1, '添加成功', array('cat_id'=>$id));
        }else{
            $this->returnAjax(0, '添加失败');
        }
    }

    /**
     * Finds the Cat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
