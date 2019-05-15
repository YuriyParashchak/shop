<?php


namespace common\components\manager;

use Yii;

/**
 * Class TransactionManager
 * @package shop\services
 */
class TransactionManager
{
    /**
     * Wraps the function with transaction.
     * @param callable $function
     * @throws \Exception
     */
    public static function wrap(callable $function)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}