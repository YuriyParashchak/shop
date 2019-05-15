<?php


namespace common\bootstrap;



use yii\base\BootstrapInterface;
use yii\caching\Cache;
use yii\mail\MailerInterface;



class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;
        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(MailerInterface::class, function () use($app){
            return $app->mailer;
        });

//        $container->setSingleton(MailerService::class, [], [
//            $app->params['senderEmail'],
//        ]);

    }
}