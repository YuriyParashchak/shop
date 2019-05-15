<?php
use yii\helpers\Html;
?>
<div class="modal-header">
    <p><?=Yii::t('menu', 'Please fill out the following fields to login')?>:</p>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <?php $form = yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'email')->textInput([
            'autofocus' => true,
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div style="color:#999;margin:1em 0">
        <?= Yii::t('menu', 'If you forgot your password you can')?> <?= Html::a(Yii::t('menu','reset it'), ['site/request-password-reset']) ?>.
    </div>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu', 'Login'), [
                'class' => 'btn btn-primary',
            'name' => 'login-button',
            'id' => 'loginSubmit'
        ]) ?>
    </div>
</div>
<?php yii\bootstrap4\ActiveForm::end(); ?>