<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use app\components\UserHelperClass;
/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 *
 * @property News[] $news
 */
class Category extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['cat_id' => 'id']);
    }

    public function getParentName($model)
    {
        return Category::find()
            ->select('c.id, c.name, cat.name as parent_name')
            ->from('category c')
            ->leftJoin('category cat', 'c.parent_id = cat.id')
            ->asArray()
            ->where('c.id = :id', [':id' => $model->id])->one()['parent_name'];
    }

    /**
     * @return array
     */
    private static function getMenuItems()
    {
        $items = array();
        $resultAll = self::find()->all();
        /*
        $resultAll = self::find()
            ->select(['{{category}}.*', 'COUNT({{news}}.id) AS news_count'])
            ->leftJoin('news', '`category`.`id` = `news`.`cat_id`')
            ->groupBy('{{category}}.id')
            ->orderBy('news_count DESC')
            ->all();
        */

        foreach($resultAll as $result)
        {
            if(empty($items[$result->parent_id]))
            {
                $items[$result->parent_id] = array();
            }

            $items[$result->parent_id][] = [
                'id' => $result->id,
                'name' => $result->name,
                'parent_id' => $result->parent_id,
                'news_count' => $result->getNews()->count(),
            ];
        }
        return $items;
    }

    /**
     * @param int $parent_id
     * @return array|void
     */
    public static function viewMenuItems($parent_id = 0)
    {
        $arrItems = self::getMenuItems();
        if(empty($arrItems[$parent_id]))
        {
            return;
        }
        $itemCount = count($arrItems[$parent_id]);
        for($i = 0; $i<$itemCount; $i++)
        {
            if($arrItems[$parent_id][$i]['news_count'] > 0)
            {
                $label = $arrItems[$parent_id][$i]['name']. ' <span class="badge badge-secondary">'.$arrItems[$parent_id][$i]['news_count'].'</span>';
                $url = Url::to([
                    '/',
                    'NewsSearch' => [
                        'cat_id'=> $arrItems[$parent_id][$i]['id']
                    ]
                ]);
            }
            else
            {
                $label = null;
                $url = null;
            }


            $result[] = [
                'news_count' => $arrItems[$parent_id][$i]['news_count'],
                'label' => $label,
                'url' => $url,
                'linkOptions'=> ['title'=>$arrItems[$parent_id][$i]['name']],
                'items' => self::viewMenuItems($arrItems[$parent_id][$i]['id']),
                'options' => ['class'=>$arrItems[$parent_id][$i]['class']],
            ];
        }


        return $result;
    }

}
