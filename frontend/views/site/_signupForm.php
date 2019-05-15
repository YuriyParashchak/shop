<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
    <p><?=Yii::t('menu','Please fill out the following fields to register')?>:</p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <?php $form = yii\bootstrap4\ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'firstName')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'lastName')->textInput() ?>

    <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <?= $form->field($model, 'confirmed')->checkbox(['style' => 'display: none'])->label(false) ?>

    <?php yii\bootstrap4\ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu','Signup') , [
            'class' => 'btn btn-primary',
            'name' => 'signup-button',
            'id' => 'signupSubmit'
        ]) ?>
    </div>
</div>
