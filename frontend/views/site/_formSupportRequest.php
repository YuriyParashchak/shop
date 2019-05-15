<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SupportRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="support-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->dropDownList(\backend\helpers\SupportRequestHelper::getSubject()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha::className(),
        ['siteKey' => '6LfqmJQUAAAAAFAeZSCEwCf6fEvk8QhA97vSKMru']
    ) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('user','Send'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
