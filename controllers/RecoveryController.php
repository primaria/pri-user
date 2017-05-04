<?php

namespace primaria\user\controllers;

use yii;
use yii\web\Controller;
use primaria\user\models\recoveryForm;

class RecoveryController extends Controller
{
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPassword()
    {
        $model = new recoveryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPassword', [
            'model' => $model,
        ]);
    }

}
