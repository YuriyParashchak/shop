<?php

use common\models\user\UserProfile;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\user\UserPhone;

/* @var $this \yii\web\View */
/* @var $model \frontend\forms\user\UserEditForm */
/* @var $phone \common\models\user\UserPhone */

//$this->registerJsVar('ROW_PHONE_JS', $this->render('row_phone_js'));
 $this->registerJsVar('PHONE_INPUT', $this->render('phone_input'));
 $this->registerJsVar('PHONES_COUNT', count($model->getWithoutDeleted()));
 $this->registerJsFile('/js/user/userphone.js',['depends' => 'yii\web\JqueryAsset']);
 $this->registerJsFile('/js/libs/cropper.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile('/js/user/avatar.js',['depends' => 'yii\web\JqueryAsset']);
 $this->registerCssFile('/css/libs/cropper.css');
$this->registerCssFile('/css/user/avatar.css');


$this->title = Yii::t('profile','Edit profile') ;
$this->params['breadcrumbs'][] = ['label' =>Yii::t('profile','Profile') , 'url' => ['/profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div >
<div class="profile-edit">
<div>
<picture>

    <img class="img-fluid img-thumbnail" id="imgFile" src="/avatar/<?= (UserProfile::findOne(['user_id' =>  Yii::$app->user->id])->avatar)? UserProfile::findOne(['user_id' =>  Yii::$app->user->id])->avatar : 'default_user.jpg'?>" alt="...">
    <br>
    <a  href="#" id="avatarka" style="text-align: center" ><?= Yii::t('profile','Change photo')?> </a>
</picture>
</div>
<div class="container mt-3">

    <!-- Button to Open the Modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
         Open modal
     </button> -->

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?= Yii::t('profile','Change photo')?></h4>
                    <button type="button" id="close_cropper" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="cropbox">
                        <img max-width="100%" src="" alt="" id="avatar">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="close_cropper" class="btn btn-danger" data-dismiss="modal"><?= Yii::t('profile','Close')?></button>
                    <button type="button" id="save_avatar" class="btn btn-success" data-dismiss="modal"><?= Yii::t('profile','Save')?></button>
                </div>

            </div>
        </div>
    </div>

</div>






<?php $form = yii\bootstrap4\ActiveForm::begin() ?>
<table class="table">
    <tr>

        <td class="add-title"><?= Yii::t('menu','Last Name')?> : </td>
        <td > <?= $form->field($model,'lastName')->label(false) ?></td>
        <td> </td>
    </tr>
    <tr>

        <td class="add-title"><?= Yii::t('menu','First Name')?> : </td>
        <td class="profile-info"><?= $form->field($model,'firstName')->label(false)  ?></td>
        <td> </td>
    </tr>
    <tr>

        <td class="add-title">Email: </td>
        <td class="profile-info"><?= $form->field($model,'email')->input('email')->label(false) ?></td>
        <td> </td>
    </tr>


        <div id="phonesList">
            <?php foreach($model->phones as  $phone):  ?>
                <?=$this->render('row_phone', ['phone'=> $phone]);?>
            <?php endforeach; ?>
        </div>
    <tr id="px"></tr>
    <tr>
        <td> </td>
        <td class="profile-info"> <a href="#" id="addPhone"><?= Yii::t('profile','Add phone')?></a></td>
        <td></td>
    </tr>
    <tr>
        <td class="add-title"><?= Yii::t('profile','Birthday')?>: </td>
        <td class="profile-info"><?= $form->field($model,'birthday')->widget(
                DatePicker::class,[
                'name' => 'dp_3',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'value' => '',
                'pickerIcon' => '<i class="fa fa-calendar"></i>',
                'removeIcon' => '<i class="fa fa-close"></i>',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]])->label(false);  ?></td>
        <td></td>
    </tr>
    <tr>
        <td class="add-title"><?= Yii::t('profile','Country')?>: </td>
        <td class="profile-info"><?= $form->field($model,'country')->label(false)  ?></td>
        <td></td>
    </tr>
    <tr>
        <td class="add-title"><?= Yii::t('profile','Region')?>: </td>
        <td class="profile-info"><?= $form->field($model,'region')->label(false)  ?></td>
        <td></td>
    </tr>
    <tr>
        <td class="add-title"><?= Yii::t('profile','City')?>: </td>
        <td class="profile-info"><?= $form->field($model,'city')->label(false)  ?></td>
        <td></td>
    </tr>

    <tr>
        <td class="add-title"><?= Yii::t('profile','Street')?>: </td>
        <td class="profile-info"><?= $form->field($model,'street')->label(false)  ?></td>
        <td></td>
    </tr>

    <tr>
        <td class="add-title"></td>
        <td class="profile-info">
            <div class="btn-save-cancel">
            <?=  Html::submitButton(Yii::t('profile','Update'),['class'=>'btn btn-success btnp']) ?>
            <a href="<?php echo Url::to(['/profile']);?>"><?= Yii::t('profile','Cancel')?></a>
            </div>
                </td>
        <td></td>
    </tr>

    </tbody>
</table>






<div style="display: none">
    <?= $form->field($model, 'imageFile')->fileInput() ?>
</div>

<?php yii\bootstrap4\ActiveForm::end() ?>


</div>
</div>


