<?php

namespace backend\controllers;

use backend\forms\blogCategory\BlogCategoryForm;
use backend\services\blogCategory\BlogCategoryService;
use Yii;
use common\models\CategoryBlog;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryBlogController implements the CRUD actions for CategoryBlog model.
 */
class CategoryBlogController extends Controller
{
    /**
     * {@inheritdoc}
     */

    /**
     * @var BlogCategoryService
     */
    private $blogCategoryService;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function __construct(string $id, Module $module, BlogCategoryService $blogCategoryService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->blogCategoryService = $blogCategoryService;
    }
    /**
     * Lists all CategoryBlog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CategoryBlog::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryBlog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CategoryBlog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogCategoryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try{
                $subject = $this->blogCategoryService->create($model);
                Yii::$app->session->setFlash('success', 'Blog Category created');
                return $this->redirect(['view', 'id' => $subject->id]);
            }
            catch (\Exception $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoryBlog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        /*$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);*/
        $category = $this->findModel($id);
        $model = new BlogCategoryForm($category);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try{
                $this->blogCategoryService->update($model, $category);
                Yii::$app->session->setFlash('success', 'Category updated');
                return $this->redirect(['view', 'id' => $category->id]);
            }
            catch(\Exception $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoryBlog model.
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
     * Finds the CategoryBlog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryBlog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryBlog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
