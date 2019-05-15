<?php

namespace frontend\controllers;


use common\models\CommentBlog;
use common\services\blog\BlogService;
use frontend\forms\CommentBlogForm;
use Yii;
use common\models\Blog;
use common\models\CategoryBlog;
use frontend\forms\BlogSearch;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{

    /**
     * @var BlogService
     */
    private $blogService;
    /**
     * {@inheritdoc}
     */

    public function __construct(string $id, Module $module, blogService $blogService, array $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->blogService = $blogService;
    }
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
     * Lists all Blog models.
     * @return mixed
     */

    public function actionIndex()
    {
        /*$query = Blog::find()->where(['status' => Blog::STATUS_POSTED]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 1]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);*/
        $categories = CategoryBlog::find()->all();

        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' =>$categories,
            'category'=> null
        ]);
    }

    public function actionCategory($url)
    {
        $category = CategoryBlog::findOne(['slug' => $url]);

        if($category == null)
            throw new NotFoundHttpException();

        $searchModel = new BlogSearch();
        $searchModel->search_category_id = $category->id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categories = CategoryBlog::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'category'=>$category,

        ]);
    }

    /**
     * Displays a single Blog model.
     * @params integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($url)
    {
        $model = Blog::findOne(['url' => $url]);

     //  $comments = $model->getArticleComments();
        $comments = new ActiveDataProvider([
            'query' => CommentBlog::find()
                ->where([
                    'article_id' => $model->id
                ])
             ->andWhere(['status'=>1]),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
      //  var_dump($comments->models);exit;
        $commentForm = new CommentBlogForm();

        if($model == null)
            throw new NotFoundHttpException();

        $this->blogService->updateViewsCounters($model);

        return $this->render('view', [
            'model' => $model,
            'comments'=>$comments,
            'commentForm'=>$commentForm
        ]);
    }
    public function actionComment($id)
    {

        $model = new CommentBlogForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());

            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            }
        }
    }


    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
