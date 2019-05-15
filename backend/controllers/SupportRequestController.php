<?php

namespace backend\controllers;

use backend\forms\message\MessageForm;
use backend\models\ContactSubject;
use common\services\user\SupportRequestService;
use Yii;
use common\models\SupportRequest;
use backend\forms\SupportRequestSearch;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupportRequestController implements the CRUD actions for SupportRequest model.
 */
class SupportRequestController extends Controller
{

    /**
     * @var SupportRequestService
     */

    private $supportRequestService;

    public function __construct(string $id, Module $module, SupportRequestService $supportRequestService,  array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->supportRequestService = $supportRequestService;

    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
        //            'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SupportRequest models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SupportRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single SupportRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        try
        {
            $this->supportRequestService->changeStatus($id);

            $modelMessage= new MessageForm($id);
            if ($modelMessage->load(Yii::$app->request->post())&&$modelMessage->validate()) {

                try {

                    $this->supportRequestService->sendMessage($modelMessage, $id);

                     Yii::$app->session->setFlash('success','Sent');
                }
                catch (\Exception $exception)
                {
                    Yii::$app->session->setFlash('error',$exception->getMessage());
                }

            }

            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelMessage' => $modelMessage
            ]);
        }
        catch (\Exception $ex){
            Yii::$app->session->setFlash('error', $ex->getMessage());
        }

    }



    /**
     * Updates an existing SupportRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        try{
            $this->supportRequestService->changeStatusProcessing($id);

            Yii::$app->session->setFlash('success','Статус був змінено на опрацьований');
            return $this->redirect(['view', 'id' => $id ]);
        }
        catch (\Exception $ex){
            Yii::$app->session->setFlash('error', $ex->getMessage());
        }
    }

    /**
     * Deletes an existing SupportRequest model.
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

/*public function actionSendMessage($id)
{

    $modelMessage= new MessageForm();

  //  var_dump($idMessage);exit;
    if ($modelMessage->load(Yii::$app->request->post())&&$modelMessage->validate()) {
        try {
           //var_dump($idMessage);exit;
           $this->supportRequestService->sendMessage($modelMessage,3);

          return $this->redirect(['index']);
           // Yii::$app->session->setFlash('error','!!!!!!!');
        }
        catch (\Exception $exception)
        {
            Yii::$app->session->setFlash('error',$exception->getMessage());
        }

    }
    return $this->renderAjax('_formMessage', [
        'modelMessage' => $modelMessage,
    ]);

}*/

    /**
     * Finds the SupportRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SupportRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupportRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
