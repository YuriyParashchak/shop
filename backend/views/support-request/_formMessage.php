<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SupportRequest */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="support-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelMessage, 'messageID')->hiddenInput(); ?>

    <?= $form->field($modelMessage, 'subject')->dropDownList(\backend\helpers\SupportRequestHelper::getSubject()) ?>

    <?= $form->field($modelMessage, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelMessage, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelMessage, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('user','Send'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
