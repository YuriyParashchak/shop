<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use dominus77\sweetalert2\Alert;
use yii\web\JqueryAsset;
use yii\bootstrap4\Breadcrumbs;
use common\models\User;
use frontend\widgets\auth\AuthWidget;

$user = Yii::$app->user->isGuest ? null : User::findByEmail(Yii::$app->user->identity->email);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
<!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
</head>
<body>
<?php $this->beginBody() ?>

    <div class="container-site">

            <?= $this->render('_navbar', [ 'user' => $user ]); ?>


                <?= Breadcrumbs::widget([ 'links' => $this->params['breadcrumbs'] ?? [] ]) ?>

                <?= $content ?>

                <?= Alert::widget(['useSessionFlash' => true]) ?>

        </div>


<?php 
    if(Yii::$app->user->isGuest)
        echo AuthWidget::widget();
?>

<?= $this->render('_footer'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
