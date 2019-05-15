<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = Yii::t('user','Create Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">


    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
