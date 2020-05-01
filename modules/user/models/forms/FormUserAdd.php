<?php

namespace app\modules\user\models\forms;
use app\modules\user\models\User;
use yii\base\Model;
use Yii;
 
/**
 * User add form
 */
class FormUserAdd extends Model
{
    public $username;
	public $email;
    public $newPassword;
    public $newPasswordRepeat;
	public $status;
 
    public function rules()
    {
        return [
			['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
            ['email', 'string', 'max' => 255],
 
            ['status', 'integer'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(User::getStatusesArray())],
			
            [['newPassword', 'newPasswordRepeat'], 'required'],
            ['newPassword', 'string', 'min' => 5],
			['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
 
    public function attributeLabels()
    {
        return [
			'username' => 'Имя пользователя',
            'email' => 'Email',
            'status' => 'Активно',
            'newPassword' => 'Пароль',
            'newPasswordRepeat' => 'Повторите пароль',
        ];
    }
 
    /**
     * @return boolean
     */
    public function save()
    {
        if ($this->validate()) {
            $user = new User();
			$user->username = $this->username;
			$user->email = $this->email;
			$user->status = $this->status;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }
}