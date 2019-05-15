<?php

namespace common\models\user;

use common\models\User;
use Yii;

/**
 * This is the model class for table "user_tmp".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $created_at
 *
 * @property VerifyToken[] $verifyTokens
 */
class UserTmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_tmp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password','last_name', 'first_name'], 'required'],
            [['created_at', 'username'], 'safe'],
            [['username', 'email','last_name', 'first_name'], 'string', 'max' => 70],
            [['phone'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 90],
            [['email'], 'unique', 'targetClass' => '\common\models\User'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerifyTokens()
    {
        return $this->hasMany(VerifyToken::class, ['user_tmp_id' => 'id']);
    }

    /**
     * @param $password
     * @return string
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        return $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public static function emailExist($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function getUser()
    {
        $user = new User();
        $user->url_name = $this->username;
        $user->password_hash = $this->password;
        $user->generateAuthKey();
        $user->email = $this->email;
        $user->status = 10;
        $user->created_at = strtotime('now');
        $user->updated_at = strtotime('now');

        return $user;
    }

    public function getUserProfile()
    {
        $userProfile = new UserProfile();
        $userProfile->first_name = $this->first_name;
        $userProfile->last_name = $this->last_name;

        return $userProfile;
    }
}
