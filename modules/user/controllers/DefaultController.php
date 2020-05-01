<?php

namespace app\modules\user\controllers;

use app\controllers\FrontendController;
 
use app\modules\user\models\forms\FormEmailConfirm;
use app\modules\user\models\forms\FormLogin;

use app\modules\user\models\forms\FormPasswordReset;
use app\modules\user\models\forms\FormPasswordResetRequest;

use app\modules\user\models\forms\FormSignup;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

use Yii;
 
class DefaultController extends FrontendController
{
 
    public function actionLogin()
    {
		$this->layout = '/popup';
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
 
        $model = new FormLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();// На главную //$this->goBack(); // по введенному адресу, в админку
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionLogout()
    {
        Yii::$app->user->logout();
 
        return $this->goHome();
    }
 
    public function actionSignup()
    {
		$this->layout = '/popup';
		
        $model = new FormSignup();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->goHome();
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
 
    public function actionEmailConfirm($token)
    {
        try {
            $model = new FormEmailConfirm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }
 
        return $this->goHome();
    }
 
    public function actionPasswordResetRequest()
    {
		$this->layout = '/popup';
		
        $model = new FormPasswordResetRequest();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
 
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
            }
        }
 
        return $this->render('passwordResetRequest', [
            'model' => $model,
        ]);
    }
 
    public function actionPasswordReset($token)
    {
		$this->layout = '/popup';
		
        try {
            $model = new FormPasswordReset($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
 
            return $this->goHome();
        }
 
        return $this->render('passwordReset', [
            'model' => $model,
        ]);
    }
}