<?php

namespace common\models\user;

use common\models\User;
use http\Exception\RuntimeException;
use Yii;

/**
 * This is the model class for table "verify_token".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $token
 * @property string $expire_at
 * @property string $user_tmp_id
 *
 * @property User $user
 * @property UserTmp $user_tmp
 */
class VerifyToken extends \yii\db\ActiveRecord
{
    const TYPE_EMAIL = 'email';
    const TYPE_PHONE = 'phone';
    const TYPE_RESET_PASSWORD = 'reset password';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['user_id', 'user_tmp_id'], 'integer'],
            [['expire_at'], 'safe'],
            [['type'], 'string', 'max' => 70],
            [['token'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['user_tmp_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserTmp::class, 'targetAttribute' => ['user_tmp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'token' => 'Token',
            'expire_at' => 'Expire At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getUser_tmp()
    {
        return $this->hasOne(UserTmp::class, ['id' => 'user_tmp_id']);
    }

    /**
     * @param $user
     * @param $type
     * @return VerifyToken
     * @throws \Exception
     */
    public static function getToken($user, $type)
    {
        $vToken = new static();
        if($user instanceof User)
            $vToken->user_id = $user->id;
        if($user instanceof UserTmp)
            $vToken->user_tmp_id = $user->id;
        $vToken->type = $type;
        $timeNow = (\strtotime('now'))  + (15*60);
        $vToken->expire_at = date("Y-m-d H:i:s", $timeNow);
        $vToken->token = (string)(\rand(100000, 999999));
        return $vToken;
    }

    public function tokenValid($token)
    {
        $currentTime = \strtotime('now');
        $tokenTime = \strtotime($this->expire_at);
        if($currentTime > $tokenTime)
            throw new \RuntimeException('Token timeout');

        if($token != $this->token){
            throw new \RuntimeException('Token not valid');
        }
    }
}
