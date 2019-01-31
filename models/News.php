<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $cat_id
 * @property int $active
 * @property string $create_date
 * @property string $title
 * @property string $preview_text
 * @property string $detail_text
 *
 * @property Comment[] $comments
 * @property Category $cat
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'active'], 'integer'],
            [['active', 'title', 'preview_text', 'detail_text'], 'required'],
            [['create_date'], 'safe'],
            [['preview_text', 'detail_text'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'active' => 'Active',
            'create_date' => 'Create Date',
            'title' => 'Title',
            'preview_text' => 'Preview Text',
            'detail_text' => 'Detail Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['news_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }
}
