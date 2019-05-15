<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\user\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'url_name',
                'label'=>'url_name',
                'format' => 'raw',
                'value'=>function ($model) {
                    return Html::a(Html::encode($model->url_name),'view?id='.$model->id);
                },
            ],
            'email:email',

            [
                'attribute' => 'status',
                'filter'=>User::getStatuses(),
                'content' => function (\common\models\User $model){
                    return $model->status == 10 ? 'active' : 'not active';
                }
            ],

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],

        ],
    ]); ?>
</div>
