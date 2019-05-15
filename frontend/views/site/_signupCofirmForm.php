<?php
use yii\helpers\Html;
?>
<div class="modal-header">
    <p>Please fill out the following field to confirm registration:</p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <?php $form = yii\bootstrap4\ActiveForm::begin(['id' => 'signup-confirm-form', 'action' => '/site/confirm-signup']); ?>
    <?= $form->field($model, 'user_tmp_id')->textInput(['style' => 'display: none'])->label(false) ?>
    <?= $form->field($model, 'type')->textInput(['style' => 'display: none'])->label(false) ?>
    <?= $form->field($model, 'token')->textInput(['autofocus' => true])
        ->label('Enter your verify token.') ?>

    <?php yii\bootstrap4\ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::submitButton('Confirm', [
            'class' => 'btn btn-primary',
            'name' => 'signup-confirm-button',
            'id' => 'signupConfirm'
        ]) ?>
    </div>
</div>