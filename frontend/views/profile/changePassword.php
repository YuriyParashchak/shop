<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\forms\user\ChangePasswordForm */

$this->title = Yii::t('profile','Change password') ;
?>

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <div class="row">

    <div class="col-md-6 offset-md-3">
        <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group text-center">
            <?= Html::submitButton(Yii::t('profile', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

        </div>

    </div>