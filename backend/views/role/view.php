<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view">



    <p>
        <?= Html::a(Yii::t('profile','Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('profile','Delete'), ['delete', 'id' => $model->name], [
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
            //'name',
            [
                'attribute' => 'name',
                'label' => Yii::t('profile','Name'),
            ],
           // 'type',
            [
                'attribute' => 'type',
                'label' => Yii::t('user','Type'),
            ],
           // 'description:ntext',
            [
                'attribute' => 'description',
                'label' => Yii::t('profile','Description'),
            ],

           // 'rule_name',
            [
                'attribute' => 'rule_name',
                'label' => Yii::t('user','Role Name'),
            ],
            //'data',
           // 'created_at',
           // 'updated_at',
        ],
    ]) ?>

</div>
