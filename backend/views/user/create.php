<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('user','Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">



    <?= $this->render('_formCreateUser', [
        'model' => $model,
    ]) ?>

</div>
