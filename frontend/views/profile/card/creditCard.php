<?php
/* @var $this yii\web\View */
/** @var $creditCard  common\models\user\CreditCard*/
/** @var $userPhone  common\models\user\UserPhone*/
/** @var common\models\User $user */





use common\models\user\CreditCard;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsVar('CARD_INPUT', $this->render('creditCardInput'));
$this->registerJsFile('/js/user/creditCard.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile('/css/user/creditCard.css');

$this->title = Yii::t('profile','Credit Card') ;
// $this->params['breadcrumbs'][] = ['label' =>Yii::t('profile','Profile') , 'url' => ['/profile']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-3">

    <!-- Button to Open the Modal -->
     <button type="button" id="addCard" class="btn btn-primary">
         <?= Yii::t('profile','Add Credit Card') ?>
     </button>

    <!-- The Modal -->
    <div class="modal fade" id="modalCard">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> <?= Yii::t('profile','Add Credit Card') ?></h4>
                    <button type="button" id="close_cropper" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>


            </div>
        </div>
    </div>

</div>
<div class="credit-cards">
<?php foreach ($creditCard as $card): ?>

   <div class="creditC" id="card_<?=$card->id?>">
       <div class='card2'>
           <div class='front'>
               <div class='top'>
                   <div class='chip' ></div>
                   <div class='cardType'>
                       <span href="#" data-card-id="<?=$card->id?>" class="fa fa-trash-o deleteCard"> </span>
                   </div>
               </div>
               <div class='middle'>
                   <div class='cd-number'>
                      <span><?=  wordwrap($card->number , 4 , '  '.' ' , true ); ?></span>
                   </div>
               </div>
               <div class='bottom'>
                   <div class='cardholder'>
                       <span class='label'><?= Yii::t('profile','Name') ?></span>
                       <span class='holder'><span><?= $card->name; ?></span></span>
                   </div>
                   <div class='expires'>
                       <span class='label'> <?= Yii::t('profile','Date expire') ?></span>
                       <span><?=Yii::$app->formatter->asDate($card->date_expire, 'MM/yy')  ?></span>
                   </div>
               </div>
           </div>

       </div>




   </div>




<?php endforeach; ?>
</div>

