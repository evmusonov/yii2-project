<?php

namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class FormSignup extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
 
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Это имя уже занято.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Этот e-mail адрес уже занят.'],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 5],
 
            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'FORM_LOGIN'),
            'password' => Yii::t('app', 'FORM_PW'),
			'email' => Yii::t('app', 'FORM_EMAIL'),
			'verifyCode' => Yii::t('app', 'FORM_VERIFY_CODE'),
        ];
    }
 
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
			$user->role = 1;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
 
            if ($user->save()) {
                Yii::$app->mailer->compose('@app/modules/user/mails/emailConfirm', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Регистрация на ' . Yii::$app->name . ', подтверждение e-mail адреса')
                    ->send();
            }
 
            return $user;
        }
 
        return null;
    }
}