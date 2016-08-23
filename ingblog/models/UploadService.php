<?php

namespace app\models;


use app\modules\post\models\File;
use app\modules\user\models\User;
use app\modules\user\models\UserInfo;
use yii\base\Model;
use Yii;
use lib\Thumb;

class UploadService extends BaseService
{
    /**
     * @var UploadedFile
     */
    public $avatar_url;
    public $editor_img;
    public $imageFiles;
    public $images = [];

    public function scenarios() {
        return [
            'avatar' => ['avatar_url'],
            'editor' => ['editor_img'],
            'images' => ['imageFiles'],
        ];
    }

    public function rules()
    {
        return [
            [['avatar_url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024*1024*1024*12, 'on'=>['avatar']],//图片大小12MB
            [['editor_img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024*1024*1024*12, 'on'=>['editor']],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024*1024*1024*12, 'maxFiles'=>100, 'on'=>['images']],
        ];
    }

    public function uploadAvatar()
    {
        if ($this->validate()) {
            $newFileName = $this::getNewFileName().'.'.$this->avatar_url->extension;
            $this->avatar_url->saveAs(Yii::$app->params['avatarDir'] . $newFileName);
            $this->avatar_url = $newFileName;
            $user_info = UserInfo::findOne(['uid' => User::getUser()->id]);
            if($user_info === null) {
                $user_info = new UserInfo();
                $user_info->uid = User::getUser()->uid;
            }
            $user_info->avatar_url = $newFileName;
            return $user_info->save();
        } else {
            return false;
        }
    }

    public function uploadImages() {
        if ($this->validate()) {
            $file_model = new File();
            foreach ($this->imageFiles as $file) {
                $newFileName = $this::getNewFileName('imagesDir').'.'.$file->extension;
                $succ = $file->saveAs(Yii::$app->params['imagesDir'].$newFileName);
                if($succ) {
                    if($file_model->checkFileMd5($newFileName)) continue;
                    //生成缩略图
                    $this->thumb(Yii::$app->params['imagesDir'] . $newFileName);
                    if($file_id = $file_model->addFile($newFileName, $file)) {
                        $this->images['id'] = $file_id;
                        $this->images['time'] = date('Y-m-d', time());
                        $this->images['url'] = BaseService::getTypeFileUrl($newFileName, 'imagesDir');
                        $this->images['name'] = substr($file->name, 0, strrpos($file->name, '.'));
                    }
                }
            }
            return $this->images;
        } else {
            return false;
        }
    }

    public static function getNewFileName($str = 'avatarDir') {
        $dir = date('Y/m/d/', time());
        if(!is_dir(Yii::$app->params[$str].$dir)) {
            mkdir(Yii::$app->params[$str].$dir,0777,true);
        }
        return $dir.date('His').rand(100000,999999);
    }

    public function showAvatar() {
        $user_info = UserInfo::findOne(['uid' => User::getUser()->id]);
        if($user_info)
            $avatar = $this->getTypeFileUrl($user_info->avatar_url, 'avatarDir', 'mid');
        if(!isset($avatar) || !file_exists($avatar)){
            $avatar = Yii::$app->params['avatarDir'].'default.jpg';
        }
        return $avatar;
    }

    public function uploadEditorImage() {
        if ($this->validate()) {
            $newFileName = $this::getNewFileName('editorDir').'.'.$this->editor_img->extension;
            $this->editor_img->saveAs(Yii::$app->params['editorDir'] . $newFileName);
            $this->editor_img = $newFileName;
            //生成缩略图
            $this->thumb(Yii::$app->params['editorDir'] . $newFileName);
            return true;
        } else {
            return false;
        }
    }

    private function thumb($img)
    {
        $thumb = new Thumb();

        //生成缩略图数组
        $thumb_arr = Yii::$app->params['imageThumbSize'];

        //裁剪后的图片路径
        $new_img = str_replace('.', '_thumb.', substr($img, 2));

        $param = array(
            'type' => 'thumb',
        );

        $thumb->set_config($param, $thumb_arr);
        $flag = $thumb->create_thumb($img, $new_img);

        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
}