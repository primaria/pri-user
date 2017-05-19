<?php

namespace primaria\user\controllers;


use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;
use primaria\user\models\RecoveryForm;
use primaria\user\User;

/**
 * RecoveryController manages password recovery process.
 *
 * @property \primaria\user\User $module
 *
 *
 */
class RecoveryController extends Controller
{


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPassword()
    {
        //$this->module->enablePasswordRecovery
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            //'scenario' => RecoveryForm::SCENARIO_REQUEST,
        ]);

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
