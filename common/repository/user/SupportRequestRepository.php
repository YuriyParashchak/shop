<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 16:54
 */

namespace common\repository\user;


use common\models\SupportRequest;

class SupportRequestRepository
{
    public function getContactSubject(int $id)
    {
        if(!$supportRequest = SupportRequest::findOne($id))
            throw new \RuntimeException('SupportRequest not found');

        return $supportRequest;
    }

    public function save(SupportRequest $supportRequest)
    {
       // var_dump($supportRequest->save());exit;
        if(!$supportRequest->save())
            throw new \RuntimeException('SupportRequest not saved');
      //  var_dump($supportRequest);exit;
    }

    /**
     * @param SupportRequest $supportRequest
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(SupportRequest $supportRequest)
    {
        if(!$supportRequest->delete())
            throw new \RuntimeException('SupportRequest not deleted');
    }


}