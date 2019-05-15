<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 16:58
 */

namespace common\services\user;


use backend\forms\message\MessageForm;
use backend\models\ContactSubject;
use common\models\SupportRequest;
use common\repository\user\SupportRequestRepository;
use frontend\forms\user\SupportRequestForm;
use Yii;

class SupportRequestService
{

    /**
     * @var SupportRequestRepository
     */
    private $supportRequestRepository;

    public function __construct(SupportRequestRepository $supportRequestRepository)
    {
        $this->supportRequestRepository = $supportRequestRepository;
    }
    public function create(SupportRequestForm $form)
    {
        $supportRequest = new SupportRequest();
        $supportRequest->name=$form->name;
        $supportRequest->subject_id = $form->subject;
        $supportRequest->email=$form->email;
        $supportRequest->body=$form->body;
        $supportRequest->status = SupportRequest::STATUS_UNREAD;
        $supportRequest->date_message = date("Y-m-d H:i:s");

        $this->supportRequestRepository->save($supportRequest);
        return $supportRequest;
    }

    public function changeStatus($id)
    {
        $supportReques=SupportRequest::findOne($id);
        if($supportReques->status!=SupportRequest::STATUS_READ &&  $supportReques->status!= SupportRequest::STATUS_PROCESSED)
        {
            $supportReques->status=SupportRequest::STATUS_READ;
            $this->supportRequestRepository->save($supportReques);
        }


    }
    public function changeStatusProcessing($id)
    {
        $supportReques=SupportRequest::findOne($id);
      // if($supportReques->status!=SupportRequest::STATUS_PROCESSED) {

           $supportReques->status = SupportRequest::STATUS_PROCESSED;
           $this->supportRequestRepository->save($supportReques);

       // }

    }

    public function sendMessage(MessageForm $messageForm,$id)
    {
        $subject=ContactSubject::findOne($messageForm->subject);

        $supportReques = SupportRequest::findOne($id);
        $supportReques->answer = $messageForm->body;
        $this->supportRequestRepository->save($supportReques);


        // TODO: get default lang
       $message= Yii::$app->mailer->compose();
       $message
            ->setFrom($messageForm->name)
            ->setTo($messageForm->email)
            ->setSubject($subject->getTitle(Yii::$app->session['language'] ?? 'ru') )
            ->setTextBody($messageForm->body);
        Yii::$app->mailer->send($message);

    }



}