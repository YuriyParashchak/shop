<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = Yii::t('user','Update Role').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
