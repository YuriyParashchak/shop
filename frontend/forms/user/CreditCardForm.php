<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 13.02.19
 * Time: 18:10
 */

namespace frontend\forms\user;


class CreditCardForm extends \yii\base\Model
{
    public $name;
    public $number1;
    public $number2;
    public $number3;
    public $number4;
    public $month;
    public $year;

public $numberCard;
public $date_expire;

    public function rules()
    {
        return [
            [['name'], 'string', 'max'=> 50 ],
            [['number1','number2','number3','number4'], 'string', 'max'=> 4 ,'min'=>4],
         //   [['number1','number2','number3','number4'], 'string', 'min'=> 4 ],

            ['month','safe'],
            ['year','safe'],

            ['numberCard','safe'],
            ['date_expire','safe'],


        ];
    }
    public function afterValidate()
    {
        $this->numberCard = \intval($this->number1 . $this->number2 . $this->number3 . $this->number4);

        $expire = new \DateTime($this->year . '-' . $this->month . '-01');
        $this->date_expire = $expire->format("Y-m-d");

        return true;
    }
}