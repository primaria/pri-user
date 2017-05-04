<?php

namespace primaria\user\controllers;


use primaria\user\models\SignupForm;
use primaria\user\models\User;
use yii;
use yii\web\Controller;
use yii\web\Response;


class RegisterController extends Controller
{

    /**
     * actionSignup: Accion del controlador DefaultController para el registro de nuevos usuarios.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user =  $model->signup()){
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);

        // return $this->render('signup');
    }
}