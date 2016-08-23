<?php
namespace app\modules\user\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            //TimestampBehavior::className(),
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['uid' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['user_login' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['user_email' => $email]);
    }

    public static function getCreatdTime($cTime)
    {
        return date('Y-m-d H:m:s',$cTime);
    }

    public static function isGuest()
    {
        return Yii::$app->user->isGuest;
    }

    public static function getUser()
    {
        return Yii::$app->user->identity;
    }

    public static function getUserName(){
        $user = Yii::$app->user->identity;
        if($user) {
            return $user->user_login;
        }else{
            return '';
        }
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    //当前用户的（cookie）认证密钥
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user_pass);
    }

    //当一个用户为第一次使用，提供了一个密码时（比如：注册时），密码就需要被哈希化
    public function setPassword($password)
    {
        $this->user_pass = Yii::$app->security->generatePasswordHash($password);
    }

    //用户注册时生成的随机字符串
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //重置用户的access_token
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function getUserInfoList() {
        $userInfo = static::find()->select(['i.*', 'u.user_login', 'u.user_email', 'u.uid as id', 'u.group_id', 'g.title as group_name'])->from('blog_user as u')->where(['u.status'=>self::STATUS_ACTIVE])
            ->leftJoin('blog_user_info as i', 'u.uid=i.uid')
            ->leftJoin('blog_user_group as g', 'u.group_id=g.id')->asArray()->all();
        return $userInfo;
    }

}