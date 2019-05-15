<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SupportRequest */

$this->title = Yii::t('user','Feedback');
//$this->params['breadcrumbs'][] = ['label' => 'Support Requests', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_formSupportRequest', [
        'model' => $model,
    ]) ?>

</div>
