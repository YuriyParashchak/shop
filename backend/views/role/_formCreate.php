<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role')->textInput()->label(Yii::t('user','Role')) ?>
    <?= $form->field($model, 'description')->textInput()->label(Yii::t('profile','Description')) ?>
    <?= $form->field($model, 'child')->dropDownList(['admin'=>'Admin','user'=>'User'])->label(Yii::t('user','Child')) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>