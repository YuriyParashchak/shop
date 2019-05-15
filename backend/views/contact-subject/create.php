<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactSubject */

$this->title =Yii::t('user', 'Create Topics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-subject-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
