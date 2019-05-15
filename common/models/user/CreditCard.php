<?php

namespace common\models\user;

use common\models\User;
use Yii;

/**
 * This is the model class for table "credit_card".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $number
 * @property integer $status
 * @property \data $date_expire
 *
 * @property User $user
 */
class CreditCard extends \yii\db\ActiveRecord
{

    const CARD_ACTIVE = 1;
    const CARD_DELETED = 3;
    const CARD_INACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credit_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'number', 'date_expire'], 'required'],
            [['user_id', 'number'], 'integer'],
            [['date_expire'], 'safe'],
            [['name'], 'string', 'max' => 70],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'name' => 'Name',
            'number' => 'Number',
            'date_expire' => 'Date Expire',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
