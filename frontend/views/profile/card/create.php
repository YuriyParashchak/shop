<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user\CreditCard */

$this->title = 'Create Credit Card';
$this->params['breadcrumbs'][] = ['label' => 'Credit Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-card-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>