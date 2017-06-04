<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \primaria\user\models\recoveryForm */

use yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = \yii::t('user','Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
            	<?php $form = ActiveForm::begin(['id' => 'request-password-form']); ?>

                	<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
					<?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

            	<?php ActiveForm::end(); ?>
        	</div>
    	</div>
	</div>
</div>