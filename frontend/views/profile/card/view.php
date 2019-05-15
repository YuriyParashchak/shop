<?php




use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\user\CreditCard */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Credit Cards', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile('/js/user/creditCard.js',['depends' => 'yii\web\JqueryAsset']);
?>




<div class="credit-card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Delete', ['delete','id'=>$model->id], [
            'class' => 'btn btn-danger',
            'id'=>'deleteCard',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'POST',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'number',
            'date_expire',
        ],
    ]) ?>

</div>