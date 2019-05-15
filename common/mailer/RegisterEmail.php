<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 01.02.19
 * Time: 16:15
 */

namespace common\mailer;


use common\models\user\UserTmp;
use common\models\user\VerifyToken;
use Yii;

class RegisterEmail implements MailerInterface
{

    /**
     * @var UserTmp
     */
    private $user;
    /**
     * @var VerifyToken
     */
    private $token;

    public function __construct(UserTmp $user, VerifyToken $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    function getSubject(string $subject = null)
    {
        if($subject)
            return $subject;

        return 'Register confirm';
    }

    function getBody()
    {
        return [
                'html' => 'register-html',
                'text' => 'register-text',
            ];
    }

    function getPart()
    {
        return [
            'userName' => $this->user->last_name . ' ' . $this->user->first_name,
            'code' => $this->token->token,
        ];
    }
}