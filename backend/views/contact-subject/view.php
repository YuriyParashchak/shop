<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactSubject */

$this->title = $model->getTitle();
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contact-subject-view">

    <p>
        <?= Html::a(Yii::t('menu','Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('menu','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
           // 'name',
            [
                'label' => Yii::t('user','Topics'),
                'value' => call_user_func(function (\backend\models\ContactSubject $contactSubject){
                    return Html::encode($contactSubject->getTitle());
                }, $model)
            ],
        ],
    ]) ?>

</div>
