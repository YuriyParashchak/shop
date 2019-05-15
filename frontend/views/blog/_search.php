<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\forms\BlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-search">

    <div class="form-search-blog" >
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <div > <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => Yii::t('blog','Search')]) ?></div>
        <div ><?= Html::submitButton(Yii::t('blog','Search'), ['class' => 'btn btn-primary']) ?></div>
        <?php ActiveForm::end(); ?>
    </div>

   <!-- <div class="input-group">
        <form method="get" action="index">

                <?=Html::input('text','BlogSearch[name]',null,['placeholder' => Yii::t('blog','Search')])?>
                <?= Html::submitButton(Yii::t('blog','Search'), ['class' => 'btn btn-primary']) ?>

        </form>
    </div>-->
</div>



