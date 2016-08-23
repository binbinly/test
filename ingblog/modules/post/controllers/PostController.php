<?php
namespace app\modules\post\controllers;

use app\controllers\UserBaseController;
use app\models\BaseService;
use app\modules\post\models\Cat;
use app\modules\post\models\File;
use app\modules\post\models\Post;
use app\modules\post\models\PostRelTag;
use app\modules\post\models\Tag;
use app\modules\post\service\CatService;
use app\modules\post\service\PostService;
use app\modules\user\models\UserInfo;
use Yii;
use yii\web\NotFoundHttpException;
use app\models\UploadService;
use yii\web\UploadedFile;

class PostController extends UserBaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        if(Yii::$app->request->isAjax) {
            $model = new Post();
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');
            $order = Yii::$app->request->post('order');
            $columns = Yii::$app->request->post('columns');
            $is_del = Yii::$app->request->post('is_del');

            //排序
            $orderBy = null;
            if($order) {
                foreach ($order as $o) {
                    $orderBy[$columns[$o['column']]['data']] = $o['dir'] == 'asc' ? SORT_ASC : SORT_DESC;
                }
            }
            $where['is_del'] = $is_del;
            $where['is_audit'] = 1;
            $cat_list = $model->getPostAll($where, $search['value'], $orderBy, $limit, $offset);
            $cat_count = $model->getPostAllCount($where);

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $cat_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $cat_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }
        return $this->render('index');
    }

    public function actionCreate()
    {
        $catList = Cat::getCatList();
        $tagList = Tag::getTagList();
        $cat_model = new CatService();

        $model = new PostService();

        //if has cover_url
        if($_FILES) {
            $upload_model = new UploadService();
            $upload_model->scenario = 'editor';
            if (Yii::$app->request->isPost) {
                $upload_model->editor_img = UploadedFile::getInstance($upload_model, 'editor_img');
                if ($upload_model->uploadEditorImage()) {
                    $model->cover_url = $upload_model->editor_img;
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->add()) {
            Yii::$app->getSession()->setFlash('success','更新成功');
            return $this->render('index');
        }
        $post_id = Yii::$app->request->get('id');
        $post_info = null;
        if($post_id) {
            $post_info = Post::find()->from('blog_post as p')->select(['p.*','c.name'])->leftJoin('blog_cat as c', 'c.cat_id=p.cat_id')
                            ->where(['p.id'=>$post_id])->asArray()->one();
            $post_info = $this->format($post_info);
        }
        return $this->render('create', ['catList'=>json_encode($catList), 'tagList'=>$tagList, 'model'=>$cat_model, 'nickname'=>UserInfo::nickName(), 'post_info'=>$post_info, 'file_model'=> File::getFileList()]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->post('post_id');
        $model = $this->findModel($id);
        if($model->is_del == 1) {//永久删除
            $succ = $model->delete();
        }else {
            $model->is_del = 1;
            $succ = $model->save();
        }
        if($succ) {
            $this->returnAjax(1, '删除成功!');
        }else{
            $this->returnAjax(0, '删除失败!');
        }
    }

    public function actionEditorUploadImage() {
        $model = new UploadService();
        $model->scenario = 'editor';
        if (Yii::$app->request->isPost) {
            $model->editor_img = UploadedFile::getInstance($model, 'editor_img');
            if ($model->uploadEditorImage()) {
                $this->returnAjax(1, '上传成功', $model->getTypeFileUrl($model->editor_img, 'editorDir', 'big'));
            }
        }
        $this->returnAjax(-1, '上传失败 '.$model->errors['editor_img'][0]);
    }

    public function findModel($id){
        $post = Post::findOne($id);
        return $post;
    }

    public function format($post){
        if($post['id']){
            $post['tag_ids'] = PostRelTag::getTagListByPostId($post['id'], true, 'tag_id');
            $post['tag_list'] = PostRelTag::getTagListByPostId($post['id'], false);
        }
        $post['cover_url'] && $post['cover_url'] = BaseService::getTypeFileUrl($post['cover_url'], 'editorDir', 'min');
        return $post;
    }
}
