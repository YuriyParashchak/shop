<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 13:02
 */

namespace backend\services\subject;

use backend\forms\subject\ContactSubjectForm;
use backend\models\ContactSubject;
use backend\repository\ContactSubjectRepository;

class ContactSubjectService
{

    /**
     * @var ContactSubjectRepository
     */
    private $repository;

    public function __construct(ContactSubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ContactSubjectForm $form)
    {
        $contactSubject = new ContactSubject();
        $contactSubject->title_us = $form->title_us;
        $contactSubject->setTitle($form->title_uk, $form->title_ru);
        $this->repository->save($contactSubject);
        return $contactSubject;
    }

    public function update(ContactSubjectForm  $form, ContactSubject $contactSubject)
    {
        $contactSubject->title_us = $form->title_us;
        $contactSubject->setTitle($form->title_uk, $form->title_ru);
        $this->repository->save($contactSubject);
        return $contactSubject;
    }

    public function delete(ContactSubject $contactSubject)
    {
        $this->repository->remove($contactSubject);
    }


}