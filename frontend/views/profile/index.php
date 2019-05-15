<?php
/* @var $this yii\web\View */
/** @var $profile  common\models\user\UserProfile*/
/** @var $userPhone  common\models\user\UserPhone*/
/** @var common\models\User $user */


use common\models\user\UserProfile;
use yii\helpers\Url;
$this->registerCssFile('/css/user/avatar.css');

$this->title = Yii::t('profile','Profile') ;
// $this->params['breadcrumbs'][] = $this->title;
?>
<!-- <h2><?= Yii::t('profile','Personal data')?></h2> -->


<!--<div class="flex-container ">
    <div class="wrapper">



        <div class="row">
            <div class="box d">short data</div>
            <div class="box e">a really long piece of data</div>
            <div class="box f">short data</div>
        </div>


        <div class="row">
            <div class="box d">short data</div>
            <div class="box e">a really long piece of data</div>
            <div class="box f">short data</div>
        </div>
    </div>
</div>-->
<div class="profile-edit">
    <picture>

        <img class="img-fluid img-thumbnail" id="imgFile" src="/avatar/<?= (UserProfile::findOne(['user_id' =>  Yii::$app->user->id])->avatar)? UserProfile::findOne(['user_id' =>  Yii::$app->user->id])->avatar : 'default_user.jpg'?>" alt="...">

    </picture>
<table class="table">
    <tr>
        <td><?= Yii::t('menu','Last Name')?> :</td>
        <td><?= $user->profile->last_name ?? ''?></td>
    </tr>
    <tr>
        <td><?= Yii::t('menu','First Name')?>:</td>
        <td><?= $user->profile->first_name ?? ''?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><?= $user->email ?? ''?></td>
    </tr>
    <tr>
        <td id="phonePoz"><?= Yii::t('profile','Phone')?>: </td>
        <td> <?php foreach ($user->userPhone as $phone)
        {
            if($phone->status!='deleted')
            {
                echo $phone->phone;echo '<br>';
            }
        }
        ?>
      <!--  <?= $user->userPhone[0]->phone  ?? ''?>-->
        </td>
        <td> <?php foreach ($user->userPhone as $phone)
            {
                if($phone->status!='deleted')
                {
                    echo $phone->status;echo '<br>';
                }
            }
            ?>
          <!--  <?= $user->userPhone[0]->status  ?? ''?>-->
        </td>
    </tr>
    <tr>
        <td><?= Yii::t('profile','Birthday')?>:</td>
        <td><?= $user->profile->birthday ?? ''?></td>
    </tr>
    <tr>
        <td><?= Yii::t('profile','Country')?>:</td>
        <td><?= $user->userAddress->country ?? ''?></td>
    </tr>
    <tr>
        <td><?= Yii::t('profile','Region')?>:</td>
        <td><?= $user->userAddress->region ?? ''?></td>
    </tr>
    <tr>
        <td><?= Yii::t('profile','City')?>:</td>
        <td><?= $user->userAddress->city ?? ''?></td>
    </tr>
    <tr>
        <td><?= Yii::t('profile','Street')?>:</td>
        <td> <?= $user->userAddress->street ?? ''?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a class="btn btn-success" href="<?php echo Url::to(['profile/edit']);?>"><?= Yii::t('profile','Edit profile')?></a>
            <a  href="<?php echo Url::to(['profile/change-password']);?>"><?= Yii::t('profile','Change password')?></a>

        </td>
        <td></td>
    </tr>

</table>

</div>


<!-- <span>LastName: </span> <?= $user->profile->last_name ?? ''?>
     <span>FirstName: </span> <?= $user->profile->first_name ?? ''?>
    <span>Email: </span> <?= $user->email ?? ''?>


    <span>Phone: </span>
    <?php foreach ($user->userPhone as $phone)
{
    if($phone->status!='deleted')
    {
        echo $phone->phone;echo '<br>';
    }


}
?>
    <?= $user->userPhone[0]->phone  ?? ''?>
    <br>

    <a href="<?php echo Url::to(['profile/edit']);?>">Edit profile</a>
    <a href="<?php echo Url::to(['profile/change-password']);?>">Change password</a>
    -->


