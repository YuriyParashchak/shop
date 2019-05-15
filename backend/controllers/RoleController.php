<?php

namespace backend\controllers;


use backend\forms\rbac\CreateRoleForm;
use backend\forms\user\UserSearch;
use common\models\User;
use Yii;
use common\models\auth\AuthItem;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for AuthItem model.
 */
class RoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AuthItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $auth = Yii::$app->authManager;
      //  $roles=AuthItem::find()->where(['!=','name'])


        $model= new CreateRoleForm();

        if ($model->load(Yii::$app->request->post())) {

            $role = $auth->createRole($model->role);
            $role->description = $model->description;
           //$role->data =  date("H:i d.m.Y");
          // $role->data =  (new \DateTime())->format("H:i d.m.Y");
            $auth->add($role);
            $auth->addChild($role,AuthItem::findOne( $model->child));


            return $this->redirect(['view', 'id' => $model->role]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddRoleUser()
    {
       /* $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('addrole', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

       /* $model= new AddRuleToUserForm();
        $users = User::findAll([
            'status' => User::STATUS_ACTIVE,
        ]);
       $user= ArrayHelper::map($users, 'id', 'email');

      //  var_dump( ArrayHelper::getColumn(Yii::$app->authManager->getRoles(), 'name'));exit;
        if ($model->load(Yii::$app->request->post())) {

           $auth = Yii::$app->authManager;
           //$userRole = $auth->getRole($model->role);
            var_dump($model->user);exit;
         //  $userId = User::findByEmail($model->user);
           var_dump($userId);exit;
          //  $auth->assign($userRole, Yii::$app->user->getId());
        }
        return $this->render('_formAddroleToUser', [
            'model' => $model,'user'=>$user,
        ]);*/

    }
}
