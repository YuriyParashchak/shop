<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 14.02.19
 * Time: 0:58
 */

namespace common\services\user;


use common\components\manager\TransactionManager;
use common\models\user\CreditCard;
use common\models\user\UserAddress;
use common\models\user\UserPhone;
use common\repository\user\CreditCardRepository;
use common\repository\user\PhoneRepository;
use common\repository\user\UserAddressRepository;
use common\repository\user\UserProfileRepository;
use frontend\forms\user\CreditCardForm;
use frontend\forms\user\UserEditForm;
use Yii;
use yii\helpers\ArrayHelper;


class UserProfileService
{
    /**
     * @var \common\repository\user\UserProfileRepository
     * @var \common\repository\user\UserAddressRepository
     * @var \common\repository\user\PhoneRepository
     * @var \common\repository\user\CreditCardRepository
     */
    private $profileRepository;
    private $addressRepository;
    private $phoneRepository;
    private $creditCardRepository;

    public function __construct(
        UserProfileRepository $profileRepository,
        UserAddressRepository $addressRepository,
        PhoneRepository $phoneRepository,
        CreditCardRepository $creditCardRepository
    )
    {
        $this->profileRepository = $profileRepository;
        $this->addressRepository = $addressRepository;
        $this->phoneRepository = $phoneRepository;
        $this->creditCardRepository = $creditCardRepository;
    }
    public function edit(UserEditForm $form, $id)
    {
        TransactionManager::wrap(function () use($form, $id) {

            $userProfile = $this->editProfile($form, $id);
            $this->profileRepository->save($userProfile);

            $userAddress=$this->editAddress($form, $id);
            $this->addressRepository->save($userAddress);

            $this->editPhoneStatus($id);


        });
    }

    public function addPhone($id)
    {
        $phone = Yii::$app->request->post('number');

        $newPhone = new UserPhone();
        $newPhone->user_id = $id;
        $newPhone->phone = $phone;
        $newPhone->status = UserPhone::PHONE_ACTIVE;

        $this->phoneRepository->save($newPhone);


    }

    public function deletePhone()
    {
        $phoneId = Yii::$app->request->post('idPhone');

        $user_phone = UserPhone::findOne($phoneId);
        $user_phone->status = UserPhone::PHONE_DELETED;
        $this->phoneRepository->save($user_phone);
    }

    public function savePhone($id,$fileName)
    {
        $profile =  $this->profileRepository->getUserProfile($id);
        $profile->avatar = $fileName;
        $this->profileRepository->save($profile);
    }


    public function createCreditCard(CreditCardForm $form,$id)
    {
        $cCard=new CreditCard();
        $cCard->name=$form->name;
        $cCard->number=$form->numberCard;
        $cCard->date_expire=$form->date_expire;
        $cCard->user_id=$id;

        $this->creditCardRepository->save($cCard);
    }


    private function editProfile(UserEditForm $form, $id)
    {
        $userProfile = $this->profileRepository->getUserProfile($id);
        $userProfile->last_name = $form->lastName;
        $userProfile->first_name = $form->firstName;
       $userProfile->birthday = $form->birthday;




        return $userProfile;
    }
    private function editAddress(UserEditForm $form, $id)
    {
       try{
           $userAddress = $this->addressRepository->getUserAddress($id);
       }
       catch (\Exception $ex)
       {
               $userAddress =  new UserAddress();
               $userAddress->user_id = $id;
       }

        $userAddress->country=$form->country;
        $userAddress->region=$form->region;
        $userAddress->city=$form->city;
        $userAddress->street=$form->street;

        return $userAddress;
    }

   private function editPhoneStatus($id)
    {
        $phoneStatus=Yii::$app->request->post('phoneStatus');
        $userPhones=$this->phoneRepository->getPhoneStatusNotDeleted($id);
        if($phoneStatus) {
            $key = array_keys($phoneStatus);
            foreach ($userPhones as $phone) {
                if (!ArrayHelper::isIn($phone->id, $key)) {
                    $phone->status = UserPhone::PHONE_INACTIVE;;
                    $this->phoneRepository->save($phone);

                } else {
                    $phone->status = UserPhone::PHONE_ACTIVE;
                    $this->phoneRepository->save($phone);
                }
            }
        }
        else {
            foreach ($userPhones as $phone) {

                $phone->status = UserPhone::PHONE_INACTIVE;;
                $this->phoneRepository->save($phone);
            }
        }
    }

}