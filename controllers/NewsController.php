<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\UserHelperClass;
use yii\data\ActiveDataProvider;

use app\models\Category;
use app\models\Comment;
use app\models\CommentSearch;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['active'=>1])->orderBy('create_date ASC');
        $dataProvider->setPagination(['pageSize' => 3]);
        $dataProvider->setSort([
            'attributes' => [
                'create_date' => [
                    'asc' => ['create_date' => SORT_ASC],
                    'desc' => ['create_date' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Сортировка по дате',
                ],
            ],
            'defaultOrder' => [
                'create_date' => SORT_ASC
            ]
        ]);


        $categories = Category::find()->asArray()->all();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($title = null)
    {
        if ($title != null)
        {
            $dataProvider = News::find()->where(['title' => $title])->one();


            #$searchModel = new CommentSearch();
            #$commentsDataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $searchCommentModel = new CommentSearch();
            $commentsDataProvider = $searchCommentModel->search(Yii::$app->request->queryParams);
            $commentsDataProvider->query->andWhere(['news_id'=>$dataProvider->getAttribute('id')])->andWhere(['status'=>Comment::STATUS_PUBLISHED])->orderBy('create_date ASC');


            $CommentModel = new Comment();
            if ($CommentModel->load(Yii::$app->request->post()))
            {
                $CommentModel->create_date = date("Y-m-d H:i:s");
                $CommentModel->status = Comment::STATUS_DRAFT;
                if($CommentModel->save())
                {
                    Yii::$app->session->setFlash("comment_add-success", "Комментарий успешно добавлен");
                    return $this->refresh();
                }

            }


            return $this->render('view', [
                'dataProvider' => $dataProvider,
                'commentsDataProvider' => $commentsDataProvider,
                'CommentModel' => $CommentModel,
            ]);
        }
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'title' => $model->title]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($title = null)
    {
        if($title != null)
        {
            $model = News::find()->where(['title' => $title])->one();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'title' => $model->title]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($title = null)
    {
        if($title != null)
        {
            News::find()->where(['title' => $title])->one()->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News|array|\yii\db\ActiveRecord
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($title = null)
    {
        if (($model = News::find()->where(['title' => $title])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
