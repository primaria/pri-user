<?php

namespace primaria\user\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use primaria\user\models\LoginForm;





/**
 * Default controller for the `Users` module
 */
class ManagerController extends Controller
{

    /**
     * @var primaria\user\User
     * @inheritdoc
     */
    public $module;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    ['allow' => true, 'actions' => ['signup'], 'roles' => ['?']],
                    ['allow' => true, 'actions' => ['logout'], 'roles' => ['@']],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // se instancia el modelo LoginForm
        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        // aqui puedes ejecutar acciones antes del login

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            // aqui puedes ejecutar acciones despues del login
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
            'module' => $this->module,
        ]);

    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
