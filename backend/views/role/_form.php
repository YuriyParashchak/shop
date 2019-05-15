<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('profile','Name')) ?>
    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true])->label(Yii::t('user','Role Name')) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label(Yii::t('profile','Description')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
