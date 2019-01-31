<?php

namespace app\models;

use app\components\UserHelperClass;
use Yii;
use app\Models\News;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $news_id
 * @property string $status
 * @property string $create_date
 * @property string $author
 * @property string $email
 * @property string $content
 *
 * @property News $news
 */
class Comment extends \yii\db\ActiveRecord
{
    /*
     * Статус опубликовано
     * */
    const STATUS_PUBLISHED = 'STATUS_PUBLISHED';
    /*
     * Статус Не опубликовано (черновик)
     * */
    const STATUS_DRAFT = 'STATUS_DRAFT';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'status', 'author', 'content'], 'required'],
            [['news_id'], 'integer'],
            [['status', 'content'], 'string'],
            [['create_date'], 'safe'],
            [['author'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 255],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'author' => 'Author',
            'email' => 'Email',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    public function getNewsName($model)
    {
        return News::find()
            ->select('title as name')
            ->from('news')
            ->asArray()
            ->where('id = :id', [':id' => $model->news_id])->one()['name'];

    }
}
