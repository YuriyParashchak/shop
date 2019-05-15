<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(User::getStatuses())->label(Yii::t('user','Status')); ?>
    <?= $form->field($model, 'newPassword')->passwordInput()->label(Yii::t('user','New Password')) ?>
    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::getColumn(Yii::$app->authManager->getRoles(), 'name'))->label(Yii::t('menu','Password')); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
