<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 03.02.19
 * Time: 18:37
 */
namespace frontend\services\user;

use common\components\manager\TransactionManager;
use common\mailer\RegisterEmail;
use common\models\item\Preference;
use common\models\user\UserTmp;
use common\models\user\VerifyToken;
use common\services\mailer\MailerService;
use frontend\models\SignupForm;
use Yii;
use yii\helpers\ArrayHelper;

class UserService
{
    /**
     * @var MailerService
     */
    private $mailer;

    public function __construct(MailerService $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param SignupForm $form
     * @throws \yii\base\Exception
     */
    public function saveUserTmp(SignupForm $form)
    {
        if($userTmp = UserTmp::emailExist($form->email)) {
            $tokenValid = $this->checkVerifyToken($userTmp);
            if($tokenValid)
                return $userTmp;
        }
        else
            $userTmp = $form->getUserTmp();

        TransactionManager::wrap(function () use($userTmp){

            if(!$userTmp->save())
                throw new \RuntimeException('UserTmp do not save');

            $verifyToken = VerifyToken::getToken($userTmp, VerifyToken::TYPE_EMAIL);

            if(!$verifyToken->save())
                throw new \RuntimeException('Verify token do not created');

            $this->mailer->sendEmail(new RegisterEmail($userTmp, $verifyToken),[
                'to' => $userTmp->email,
            ]);

        });
        return $userTmp;
    }

    public function checkVerifyToken(UserTmp $userTmp)
    {
        $token = VerifyToken::findOne(['user_tmp_id' => $userTmp->id, 'type' => VerifyToken::TYPE_EMAIL]);
        if(!$token)
            return false;

        $currentTime = \strtotime('now');
        $tokenTime = \strtotime($token->expire_at);

        if($currentTime > $tokenTime){
            if(!$token->delete())
                throw new \RuntimeException('Verify token is exist but not valid');
        }
        else{
            return true;
        }
    }

    public function signupUser(VerifyToken $token)
    {
        TransactionManager::wrap(function () use($token){
            $curentToken = VerifyToken::findOne(['user_tmp_id' => $token->user_tmp_id, 'type' => $token->type]);
            $curentToken->tokenValid($token->token);

            $userTmp = UserTmp::findOne(['id' => $token->user_tmp_id]);
            $user = $userTmp->getUser();

            if(!$user->save())
                throw new \RuntimeException('User not saved');

            if(!$user->save())
                throw new \RuntimeException('User not saved');

            $userProfile = $userTmp->getUserProfile();
            $userProfile->user_id = $user->id;
            if(!$userProfile->save())
                throw new \RuntimeException('User profile not saved');

            if(!$curentToken->delete())
                throw new \RuntimeException('Token not deleted');

            if(!$userTmp->delete())
                throw new \RuntimeException('User tmp not deleted');

            if(!Yii::$app->getUser()->login($user))
                throw new \RuntimeException('User not login');
        });
    }

    public function getPreference(int $userId)
    {
        return ArrayHelper::getValue(Preference::findAll(['user_id' => $userId]),'product_id');
    }
}