<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactSubject */

//$this->title = 'Update Contact Subject: ' . $model->name;
$this->title = Yii::t('menu','Edit') . ' : ' . $model->getTitle(Yii::$app->session['language']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu','Edit'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->getTitle(Yii::$app->session['language']), 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('menu', 'Edit');
?>
<div class="contact-subject-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
