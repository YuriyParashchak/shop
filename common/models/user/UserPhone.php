<?php

namespace common\models\user;

use common\models\item\GoodsPhone;
use common\models\User;


/**
 * This is the model class for table "user_phones".
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $status
 *
 * @property GoodsPhone[] $goodsPhones
 * @property User $user
 */
class UserPhone extends \yii\db\ActiveRecord
{
    const PHONE_ACTIVE = 'active';
    const PHONE_DELETED = 'deleted';
    const PHONE_INACTIVE = 'inactive';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_phones';
    }

    public static function getStatuses() {
        return [
            self::PHONE_ACTIVE => "active",
            self::PHONE_INACTIVE => "not active",
            self::PHONE_DELETED=> "deleted",
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['phone', 'status'], 'required'],
            [['phone'], 'string', 'max' => 30,'min'=>9],
            [['status'], 'string', 'max' => 20, ],
            [['status'], 'default','value'=>self::PHONE_ACTIVE ],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'phone' => 'Phone',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsPhones()
    {
        return $this->hasMany(GoodsPhone::class, ['phone_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
