<?php

namespace common\models;

use backend\models\ContactSubject;
use DateTime;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;

/**
 * This is the model class for table "support_request".
 *
 * @property int $id
 * @property int $subject_id
 * @property string $name
 * @property string $email
 * @property string $body
 * @property integer $status
 * @property datetime $date_message
 * @property string $answer
 *
 * @property ContactSubject $subject
 */
class SupportRequest extends \yii\db\ActiveRecord
{
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;
    const STATUS_PROCESSED = 10;


    public static function getStatuses()
    {
        return [

            self::STATUS_READ =>Yii::t('user','Read'),
            self::STATUS_UNREAD=> Yii::t('user','Unread'),
            self::STATUS_PROCESSED => Yii::t('user','Processed')

        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'body'], 'required'],
            [['subject_id'], 'integer'],
            [['body','answer'], 'string'],
            [['date_message','answer','status'], 'safe'],
            [['name', 'email'], 'string', 'max' => 70],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactSubject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [[], ReCaptchaValidator::className(), 'secret' => '6LfqmJQUAAAAAJ_K-I2EQlppG6m0lPB8ArzQg2N8']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => Yii::t('user','Topic'),
            'name' => Yii::t('user','Name'),
            'email' => 'Email',
            'body' => Yii::t('user','Message'),
            'date_message'=> Yii::t('user','Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(ContactSubject::className(), ['id' => 'subject_id']);
    }
}
