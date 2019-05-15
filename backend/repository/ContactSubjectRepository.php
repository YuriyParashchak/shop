<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 12:56
 */

namespace backend\repository;

use backend\models\ContactSubject;

class ContactSubjectRepository
{
    public function getContactSubject(int $id)
    {
        if(!$contactSubject = ContactSubject::findOne($id))
            throw new \RuntimeException('ContactSubject not found');

        return $contactSubject;
    }

    public function save(ContactSubject $contactSubject)
    {
        if(!$contactSubject->save())
            throw new \RuntimeException('ContactSubject not saved');
    }

    /**
     * @param ContactSubject $contactSubject
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(ContactSubject $contactSubject)
    {
        if(!$contactSubject->delete())
            throw new \RuntimeException('ContactSubject not deleted');
    }


}