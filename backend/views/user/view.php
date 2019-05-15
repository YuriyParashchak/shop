<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('user','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url_name:url',
            'email:email',
            'status',

           [
                   'label'=>Yii::t('menu','Last Name'),
                   'value'=>call_user_func(function ($user)
                   {
                       return Html::encode($user->profile->last_name);
                   },$model)
           ],
            [
                'label'=>Yii::t('menu','First Name'),
                'value'=>call_user_func(function ($user)
                {
                    return Html::encode($user->profile->first_name);
                },$model)
            ],
            [
                'label'=>Yii::t('menu','Phone'),
                'format' => 'html',
                'value'=>call_user_func(function ($user)
                {
                    $phones = '';
                    foreach ($user->userPhone as $phone)
                    {
                        $phones .= Html::tag('div', '<b>' . $phone->phone .' </b> - '.$phone->status);

                    }
                    return $phones;
                },$model)
            ],

           // 'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
