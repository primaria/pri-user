<?php

namespace primaria\user\controllers;

use primaria\user\models\RecoveryForm;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


/**
 * RecoveryController manages password recovery process.
 *
 * @property \primaria\user\user $module
 *
 * @author Primaria
 */
class RecoveryController extends Controller
{
    /**
     * Shows page where user can request password recovery.
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRequest()
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryForm $model */
        $model = \Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => RecoveryForm::SCENARIO_REQUEST,
        ]);
        //$event = $this->getFormEvent($model);

        //$this->performAjaxValidation($model);
        //$this->trigger(self::EVENT_BEFORE_REQUEST, $event);

        /*if ($model->load(\Yii::$app->request->post()) && $model->sendRecoveryMessage()) {
            $this->trigger(self::EVENT_AFTER_REQUEST, $event);
            return $this->render('/message', [
                'title'  => \Yii::t('user', 'Recovery message sent'),
                'module' => $this->module,
            ]);
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }
}