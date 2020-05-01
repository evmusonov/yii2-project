<?php

namespace app\modules\main\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormVacancy extends Model
{
    public $name;
    public $email;
    public $phone;
    public $agree;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone'], 'required'],
	        ['agree', 'required', 'requiredValue' => 1, 'message' => 'Подтвердите согласие на обработку данных']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'E-mail',
	        'agree' => 'Соглашение'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function send($email)
    {
        if ($this->validate()) 
		{
			$mailer = Yii::$app->mailer;
			$setFrom = Yii::$app->view->params['siteinfo']->email;
			$setTo = $email;
			
			if(isset(Yii::$app->view->params['setting']) && !empty(Yii::$app->view->params['setting']) && isset(Yii::$app->view->params['setting']['smtp_host']) && !empty(Yii::$app->view->params['setting']['smtp_host'])){
				$transport = [
					'class' => 'Swift_SmtpTransport',
					'host' => Yii::$app->view->params['setting']['smtp_host'],
					'username' => Yii::$app->view->params['setting']['smtp_username'],
					'password' => Yii::$app->view->params['setting']['smtp_password'],
					'port' => Yii::$app->view->params['setting']['smtp_port'],
					'encryption' => Yii::$app->view->params['setting']['smtp_encryption'],
				];

				$mailer->setTransport($transport);
				$setFrom = Yii::$app->view->params['setting']['smtp_username'];
			}


            return $mailer->compose()
                ->setTo($setTo)
                ->setFrom([$setFrom => Yii::$app->name])
                ->setReplyTo([$setFrom => Yii::$app->name])
                ->setSubject('Сообщение из формы вакансий')
                ->setHtmlBody('Имя: ' . $this->name.'<br>Телефон: '.$this->phone.'<br>E-mail: '.$this->email)
                ->send();
        } 
		else 
		{
            return false;
        }
    }
}
