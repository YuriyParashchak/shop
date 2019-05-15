<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 10.01.19
 * Time: 19:12
 */

namespace common\mailer;




interface MailerInterface
{
    function getSubject(string $subject = null);

    function getBody();

    function getPart();
}