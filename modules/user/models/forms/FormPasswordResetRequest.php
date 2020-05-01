<?php
namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Password reset request form
 */
class FormPasswordResetRequest extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => 'app\modules\user\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Пользователь с таким e-mail адресом не зарегистрирован или не активен.'
            ],
        ];
    }
	
	public function attributeLabels()
    {
        return [
			'email' => Yii::t('app', 'FORM_EMAIL'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return Yii::$app->mailer->compose('@app/modules/user/mails/passwordReset', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Восстановление пароля на ' . \Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }
}
