<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SupportRequest */

$this->registerJsFile('/js/supportRequest',['depends' => 'yii\web\JqueryAsset']);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user','Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>



<div class="container mt-3">



    <!-- The Modal -->
    <div class="modal fade" id="modalCard">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" id="close_cropper" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"> Message</h4>

                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?= /** @var backend\forms\message\MessageForm $modelMessage */
                    $this->render('_formMessage', ['modelMessage' => $modelMessage])?>
                </div>


            </div>
        </div>
    </div>

</div>



<div class="support-request-view">


    <p>

        <?php if($model->status!=\common\models\SupportRequest::STATUS_PROCESSED)
        {
          echo  Html::a('<i class="fa fa-check"></i> '.Yii::t('user','Processed'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-success'

            ]) ;
        }

        ?>
          <?= Html::a('<i class="fa fa-trash"></i> '.Yii::t('menu','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <!-- Button to Open the Modal -->

    </p>
<div style="width:519px">

    <table class="table">
        <tr>
            <td><strong>ID:</strong></td>
            <td><?=$model->id?></td>
        </tr>
        <tr>
            <td><strong><?=Yii::t('user','Name')?>:</strong></td>
            <td><?=$model->name?></td>
        </tr>
        <tr>
            <td><strong><?=Yii::t('user','Topic')?>:</td>
            <td><?= \backend\models\ContactSubject::findOne($model->subject_id)->getTitle()?></strong></td>
        </tr>
        <tr>
            <td><strong><?=Yii::t('user','Email')?>:</strong></td>
            <td><?= $model->email?></td>
        </tr>
        <tr>
            <td><strong><?=Yii::t('user','Message')?>:</strong></td>
            <td></td>
        </tr>
        <tr>

            <td><div><?= $model->body?></div></td>
        </tr>
        <tr>
            <td><strong><?=Yii::t('user','Answer')?>:</strong></td>
            <td></td>
        </tr>
        <tr>

            <td><div><?= $model->answer?></div></td>
        </tr>
    </table>
</div>
    <button type="button" id="sendMessage" data-message-id=<?=$model->id?> class="btn btn-primary">
    <i class="fa fa-envelope"></i> <?= Yii::t('user','Send message') ?>
    </button>
</div>
