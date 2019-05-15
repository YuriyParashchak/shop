<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment_blog".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $article_id
 * @property int $status
 * @property string $date
 *
 * @property Blog $article
 * @property User $user
 */
class CommentBlog extends \yii\db\ActiveRecord
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 0;

    public static function getStatuses()
    {
        return [

            self::STATUS_ALLOW  =>Yii::t('blog','Posted'),
            self::STATUS_DISALLOW => Yii::t('blog','Unpublished'),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['article_id' => 'id']],
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
            'text' => Yii::t('blog','Text'),
            'user_id' =>  Yii::t('blog','User'),
            'article_id' => Yii::t('blog','Blog'),
            'status' => Yii::t('blog','Status'),
            'date' => Yii::t('blog','Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Blog::class, ['id' => 'article_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public function isAllowed()
    {
        return $this->status;
    }
    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }
    public function disallow()
    {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }
}
