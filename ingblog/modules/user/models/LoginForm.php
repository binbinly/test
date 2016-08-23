<?php
namespace app\modules\user\models;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

   public function attributeLabels()
   {
       return [
           'username' => Yii::t('user', 'Username'),
           'password' => Yii::t('user', 'Password'),
           'rememberMe' => Yii::t('user', 'Remember Me'),
       ];
   }
   
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user){
                $this->addError('username', '用户不存在');
            }else if(!$user->validatePassword($this->password)){
                $this->addError('password', '密码错误');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function register() {
        if($this->validate()){
            $user = new User();
            $user->user_login = $this->username;
            $user->setPassword($this->password);
            $user->ip = Yii::$app->request->userIP;
            $user->generateAuthKey();
            $user->generateAccessToken();
//            $sendEmailSuccess = yii::$app->mailer->compose('ActivateAccountToken',['user'=>$user])
//                ->setFrom([yii::$app->params['smtpUser'] => Yii::$app->params['siteName']])
//                ->setTo($this->email)
//                ->setSubject(Yii::$app->params['siteName'].'激活账号')
//                ->send();
            //当发送邮件成功时才进行保存用户
            if(true || $sendEmailSuccess){
                return $id = $user->save();
            }else{
                $this->addError('email','请提供有效的邮箱地址');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            if(strpos($this->username, '@')){
                $this->_user = User::findByEmail($this->username);
            }else{
                $this->_user = User::findByUsername($this->username);
            }
        }
        return $this->_user;
    }
}