<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\user\CreditCard */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('/js/user/creditCard.js',['depends' => 'yii\web\JqueryAsset']);
?>



<div class='center'>
    <div class='card'>
        <div class='front'>
            <div class='top'>
                <div class='chip'></div>
                <div class='cardType'>

                </div>
            </div>
            <div class='middle'>
                <div class='cd-number'>
                    <p><span class='num-1'>1234</span><span class='num-2'>1234</span><span class='num-3'>1234</span><span class='num-4'>1234</span></p>
                </div>
            </div>
            <div class='bottom'>
                <div class='cardholder'>
                    <p class='label'>Cardholder</p>
                    <p class='holder'>Firstname Lastname</p>
                </div>
                <div class='expires'>
                    <p class='label'>Good Thru<a</p>
                    <p><span class='month'>09</span>/<span class='year'>19</span></p>
                </div>
            </div>
        </div>

    </div>
    <div class='form'>
        <?php $form = yii\bootstrap4\ActiveForm::begin() ?>

            <div class='cd-numbers'>
                <label>Cardnumber</label>
                <div class='fields'>
                    <?= $form->field($model,'number1')->textInput(['class'=>'1','maxlength'=>4,])->label(false) ?>
                    <?= $form->field($model,'number2')->textInput(['class'=>'2','maxlength'=>4])->label(false) ?>
                    <?= $form->field($model,'number3')->textInput(['class'=>'3','maxlength'=>4])->label(false) ?>
                    <?= $form->field($model,'number4')->textInput(['class'=>'4','maxlength'=>4])->label(false) ?>
                 <!--  <input type='text' class='1' maxlength="4" />
                    <input type='text' class='2'  maxlength="4" />
                    <input type='text' class='3'  maxlength="4" />
                    <input type='text' class='4' maxlength="4" />-->
                </div>
            </div>
            <div class='cd-holder'>
                <label for='cd-holder-input'>Cardholder</label>
                <?= $form->field($model,'name')->textInput(['id'=>'cd-holder-input','maxlength'=>50])->label(false) ?>
                <!--<input type='text' id='cd-holder-input' />-->
            </div>
            <div class='cd-validate'>
                <div class='expiration'>
                    <div class='field'>
                        <label for='month'>Month</label>
                        <?= $form->field($model,'month')->dropDownList(
                                [
                                    '01' => '01',
                                    '02' => '02',
                                    '03'=>'03',
                                    '04' => '04',
                                    '05' => '05',
                                    '06'=>'06',
                                    '07' => '07',
                                    '08' => '08',
                                    '09'=>'09',
                                    '10' => '10',
                                    '11' => '11',
                                    '12'=>'12',
                                ]
                        )->label(false) ?>
                        <!--<select id='month'>
                            <option value='01'>01</option>
                            <option value='02'>02</option>
                            <option value='03'>03</option>
                            <option value='04'>04</option>
                            <option value='06'>06</option>
                            <option value='07'>07</option>
                            <option value='08'>08</option>
                            <option value='09'>09</option>
                            <option value='10'>10</option>
                            <option value='11'>11</option>
                            <option value='12'>12</option>
                        </select>-->
                    </div>
                    <div class='field'>
                        <label for='year'>Year</label>
                        <?= $form->field($model,'year')->dropDownList(
                            [
                                '16' => '16',
                                '17' => '17',
                                '18'=>'18',
                                '19' => '19',
                                '20' => '20',
                                '21'=>'21',
                                '22' => '22',
                                '23' => '23',
                                '24'=>'24',
                                '25' => '25',
                                '26' => '26',
                                '27'=>'27',
                            ]
                        )->label(false) ?>
                        <!--<select id='year'>
                            <option value='16'>16</option>
                            <option value='17'>17</option>
                            <option value='18'>18</option>
                            <option value='19'>19</option>
                            <option value='20'>20</option>
                            <option value='21'>21</option>
                            <option value='22'>22</option>
                            <option value='23'>23</option>
                            <option value='24'>24</option>
                            <option value='25'>25</option>
                        </select>-->
                    </div>
                </div>

            </div>
            <button class='submit'><i class="fa fa-credit-card" aria-hidden="true"></i></button>

        <?php yii\bootstrap4\ActiveForm::end() ?>
    </div>
</div>
