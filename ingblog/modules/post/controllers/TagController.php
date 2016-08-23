<?php

namespace app\modules\post\controllers;

use app\controllers\UserBaseController;
use app\modules\post\models\Tag;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatController implements the CRUD actions for Cat model.
 */
class TagController extends UserBaseController
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

    public function actionAjaxAddTag() {
        $tagName = Yii::$app->request->post('tagName');
        $cat = new Tag();
        $id = $cat->addTag($tagName);
        if($id) {
            $this->returnAjax(1, '添加成功', array('tag_id'=>$id));
        }else{
            $this->returnAjax(0, '添加失败');
        }
    }

    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
