<?php

namespace backend\controllers;

use common\models\BlogHit;
use Yii;
use common\models\Blog;
use backend\forms\blog\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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
                  //  'delete' => ['POST'],
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
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
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
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            try
            {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            catch (\Exception $ex)
            {
                Yii::$app->session->setFlash('error',$ex->getMessage());
            }



        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionPublish($id)
    {

        try{
            $model = $this->findModel($id);
            $model->status = Blog::STATUS_POSTED;

            if(!$model->save())
            {
                var_dump($model->errors);exit;
            }

            Yii::$app->session->setFlash('success','Пост був публікований');
            return $this->redirect(['view', 'id' => $id ]);
        }
        catch (\Exception $ex){
            Yii::$app->session->setFlash('error', $ex->getMessage());
            return $this->redirect(['view', 'id' => $id ]);

        }
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
        $model = $this->findModel($id);

        if($model)
        {
            if($model->image_post)
            {
                $path = Yii::getAlias('@frontendWeb/imagePost/thumbnail-500x500/') . $model->image_post;

                BlogHit::deleteAll(['blog_id' => $id]);

                if(file_exists($path))
                    @unlink($path);

                $model->delete();
            }

        }

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
