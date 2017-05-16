<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use primaria\user\User;

/**
 * @var $this yii\web\View
 * @var $model primaria\user\models\LoginForm
 * @var $module primaria\user\User
 */

$this->title = yii::t('user','Login') ;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                 <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['/user/recovery/request-password']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('user','Sign in'),['class' => 'btn btn-primary btn-block', 'tabindex' => '4']) ?>
                </div>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php if ($module->enableRegistration): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/register/register']) ?>
            </p>
        <?php endif ?>
    </div>
</div>

