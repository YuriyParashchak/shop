<?php

namespace backend\controllers;

use backend\forms\subject\ContactSubjectForm;
use backend\services\subject\ContactSubjectService;
use Yii;
use backend\models\ContactSubject;
use backend\forms\ContactSubjectSearch;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactSubjectController implements the CRUD actions for ContactSubject model.
 */
class ContactSubjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /**
     * @var ContactSubjectService
     */
    private $contactSubjectService;

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
    public function __construct(string $id, Module $module, ContactSubjectService $contactSubjectService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->contactSubjectService = $contactSubjectService;
    }
    /**
     * Lists all ContactSubject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContactSubject model.
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
     * Creates a new ContactSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContactSubjectForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try{
                $subject = $this->contactSubjectService->create($model);
                Yii::$app->session->setFlash('success', 'Subject created');
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
     * Updates an existing ContactSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $subject = $this->findModel($id);
        $model = new ContactSubjectForm($subject);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try{
                $this->contactSubjectService->update($model, $subject);
                Yii::$app->session->setFlash('success', 'Subject updated');
                return $this->redirect(['view', 'id' => $subject->id]);
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
     * Deletes an existing ContactSubject model.
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
     * Finds the ContactSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContactSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContactSubject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
