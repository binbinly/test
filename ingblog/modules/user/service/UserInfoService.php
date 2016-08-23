<?php
namespace app\modules\user\service;
use app\modules\user\models\UserInfo;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

class UserInfoService extends Model
{
    public $gender;
    public $birthday;
    public $signature;
    public $qq;
    public $location;
    public $nickname;
    public $uid;
    public $group_id;
    public $user_login;
    public $user_email;
    public $password;
    public $password_repeat;

    public $_info = null;

    public function __construct()
    {
        parent::__construct();
        $this->scenario = 'add';
    }

    public function scenarios() {
        return [
            'edit' => ['uid', 'gender', 'birthday', 'signature', 'qq', 'location', 'nickname', 'group_id', 'user_email'],
            'add' => ['uid', 'gender', 'birthday', 'signature', 'qq', 'location', 'nickname', 'group_id', 'user_email', 'user_login', 'password', 'password_repeat'],
        ];
    }

    public function rules()
    {
        return [
            [['user_login', 'user_email', 'password', 'password_repeat'], 'required'],
            [['user_login', 'password', 'password_repeat'], 'string', 'length' => [6, 20]],
            [['uid', 'gender', 'qq', 'location', 'group_id'], 'integer'],
            [['birthday','nickname','signature'], 'string', 'max' => 255],
            ['password_repeat','compare','compareAttribute' =>'password','message'=>'两次输入的密码不一致。'],
            ['password', 'checkPassword'],
            ['user_email', 'email'],
            ['user_login', 'checkUserLogin'],
        ];
    }

    public function checkPassword()
    {
        if (ctype_alnum($this->password)) {
            $this->addError('password', '必须包含字母和数字之外的其他字符。');
        }
    }

    public function checkUserLogin()
    {
        $user = User::findOne(['user_login'=>$this->user_login]);
        if($user){
            $this->addError('user_login', '该用户名已存在!');
        }
    }

    public function attributeLabels()
    {
        return [
            'avatar_url' => Yii::t('user', 'Image'),
            'gender' => Yii::t('user', 'Sex'),
            'signature' => Yii::t('user', 'Signature'),
            'qq' => Yii::t('user', 'Qq'),
            'location' => Yii::t('user', 'Location'),
            'birthday' => Yii::t('user','Birthday'),
            'nickname' => Yii::t('user', 'Nickname'),
            'group_id' => '所属用户组',
            'user_login' => '用户名',
            'user_email' => '用户邮箱',
            'password' => '密码',
            'password_repeat' => '重复密码'
        ];
    }

    public function saveUserInfo() {
        if($this->validate()) {
            if($this->uid){
                $user_info = UserInfo::findOne($this->uid);
                if($user_info === null) {
                    $user_info = new UserInfo();
                    $user_info->uid = $this->uid;
                }else {
                    $user_info->gender = $this->gender;
                    $user_info->signature = $this->signature;
                    $user_info->qq = $this->qq;
                    $user_info->location = $this->location;
                    $user_info->birthday = strtotime($this->birthday);
                    $user_info->nickname = $this->nickname;
                }

                $user = User::findIdentity($this->uid);
                if($user === null) $this->addError('非法操作!');
                $this->group_id && $user->group_id = $this->group_id;
                $user->user_email = $this->user_email;


                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    $succ1 = $user_info->save();
                    $succ2 = $user->save();
                    if($succ1 && $succ2) {
                        $transaction->commit();
                        return true;
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    $this->addError('修改失败!');
                }
            }else {
                $user_info = new UserInfo();
                $this->gender && $user_info->gender = $this->gender;
                $this->signature && $user_info->signature = $this->signature;
                $this->qq && $user_info->qq = $this->qq;
                $this->location && $user_info->location = $this->location;
                $this->birthday && $user_info->birthday = strtotime($this->birthday);
                $this->nickname && $user_info->nickname = $this->nickname;

                $user = new User();
                $user->user_login = $this->user_login;
                $user->user_email = $this->user_email;
                $user->ctime = time();
                $user->setPassword($this->password);
                $user->ip = Yii::$app->request->userIP;
                $user->generateAuthKey();
                $user->generateAccessToken();
//                $sendEmailSuccess = Yii::$app->mailer->compose('ActivateAccountToken',['user'=>$user])
//                    ->setFrom(Yii::$app->params['mailerUser'])
//                    ->setTo($this->user_email)
//                    ->setSubject(Yii::$app->params['siteName'].'激活账号')
//                    ->send();
                //当发送邮件成功时才进行保存用户
                if(true){
                    $db = Yii::$app->db;
                    $transaction = $db->beginTransaction();
                    try {
                        $succ1 = $user->save();
                        if($succ1) {
                            $user_info->uid = $user->primaryKey;
                            $succ2 = $user_info->save();
                            if ($succ1 && $succ2) {
                                $transaction->commit();
                                return true;
                            }
                        }
                        $this->addError('user_login', '失败了哦!');
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        $this->addError('user_login', '修改失败!');
                    }
                }else{
                    $this->addError('user_email','请提供有效的邮箱地址');
                }
            }
        }
        return null;
    }

    public function getInfo($uid) {
        if($uid){
            $this->_info = UserInfo::findOne($uid);
            $this->user_login = User::getUser()->user_login;
            $this->user_email = User::getUser()->user_email;
            $this->group_id = User::getUser()->group_id;
            $this->uid = User::getUser()->uid;
        }
        if($this->_info) {
            $this->gender = $this->_info->gender;
            $this->signature = $this->_info->signature;
            $this->qq = $this->_info->qq;
            $this->location = $this->_info->location;
            $this->birthday = date("Y-m-d",$this->_info->birthday);
            $this->nickname = $this->_info->nickname;
        }else{
            $this->_info = new UserInfo();
        }
        return $this;
    }

    public static function getGender($sex) {
        switch ($sex){
            case '1':
                return '男';
                break;
            case '2':
                return '女';
                break;
            default:
                return '';
                break;
        }
    }
}