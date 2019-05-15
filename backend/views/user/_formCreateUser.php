<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lastName')->textInput()->label(Yii::t('menu','Last Name')); ?>
    <?= $form->field($model, 'firstName')->textInput()->label(Yii::t('menu','First Name')); ?>
    <?= $form->field($model, 'email')->textInput(); ?>
    <?= $form->field($model, 'status')->dropDownList(User::getStatuses())->label(Yii::t('user','Status')); ?>
    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('menu','Password')) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
