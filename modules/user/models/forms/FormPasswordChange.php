<?php

namespace app\modules\user\models\forms;
use app\modules\user\models\User; 
use yii\base\Model;
use Yii;
 
/**
 * Password reset form
 */
class FormPasswordChange extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;
 
    /**
     * @var User
     */
    private $_user;
 
    /**
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }
 
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'validatePassword'],
            ['newPassword', 'string', 'min' => 5],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }
 
    public function attributeLabels()
    {
        return [
			'currentPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'newPasswordRepeat' => 'Повторите новый пароль',
        ];
    }
 
    /**
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }
 
    /**
     * @return boolean
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }
}