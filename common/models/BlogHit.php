<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "blog_hit".
 *
 * @property int $id
 * @property int $event_type 1-view, 2-like
 * @property int $blog_id
 * @property int $user_id
 * @property string $ip_address
 * @property string $click_date
 *
 * @property Blog $blog
 * @property User $user
 */
class BlogHit extends \yii\db\ActiveRecord
{

    const TYPE_VIEW = 1;
    const TYPE_LIKE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_hit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_type', 'blog_id', 'ip_address'], 'required'],
            [['event_type', 'blog_id', 'user_id'], 'integer'],
            [['click_date'], 'safe'],
            [['ip_address'], 'string', 'max' => 30],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
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
            'event_type' => 'Event Type',
            'blog_id' => 'Blog ID',
            'user_id' => 'User ID',
            'ip_address' => 'Ip Address',
            'click_date' => 'Click Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        $this->ip_address = Html::encode($this->ip_address);

        return parent::beforeSave($insert);
    }

    public static function createPostHit($user_id, int $blog_id, $type)
    {
        $view_event = new static();
        $view_event->event_type = $type;
        $view_event->user_id = $user_id;
        $view_event->blog_id = $blog_id;
        $view_event->ip_address = Yii::$app->request->userIP;

        return $view_event;
    }
}
