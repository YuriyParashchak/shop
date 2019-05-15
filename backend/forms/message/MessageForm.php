<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.02.19
 * Time: 19:40
 */
namespace backend\forms\message;

use common\models\SupportRequest;
use Yii;

class MessageForm extends \yii\base\Model
{
    public $messageID;
    public $name;
    public $email;
    public $subject;
    public $body;


   public function __construct($idMessage)
    {
            $this->name ='tc@gmail.com';
            if (SupportRequest::findOne( $idMessage ))
            {
                $this->email= SupportRequest::findOne( $idMessage )->email;
                $this->subject=SupportRequest::findOne( $idMessage)->subject;
            }


    }

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],

        ];
    }
    public function attributeLabels()
    {
        return [

            'name' => Yii::t('user','Name'),
            'subject' => Yii::t('user','Topics'),
            'body' => Yii::t('user','Message'),
        ];
    }



}