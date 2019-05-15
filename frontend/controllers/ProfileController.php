<?php

namespace frontend\controllers;

use common\models\item\Goods;
use common\models\User;
use common\models\user\CreditCard;
use common\models\user\UserAddress;
use common\models\user\UserPhone;
use common\models\user\UserProfile;
use common\repository\user\PhoneRepository;
use frontend\forms\user\ChangePasswordForm;
use frontend\forms\user\CreditCardForm;
use frontend\forms\user\UserEditForm;

use common\services\user\UserProfileService;
use SplFileInfo;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\base\Module;

class ProfileController extends \yii\web\Controller
{
    public $layout = '_cabinet_layout';
    /**
     * @var UserProfileService
     */
    private $service;
    private $phoneRepository;

    public function __construct(string $id, Module $module, UserProfileService $service, PhoneRepository $phoneRepository, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->phoneRepository=$phoneRepository;
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->id;
        $user = User::findOne($id);
        return $this->render('index', ['user'=> $user ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->user->id;
        $model = new UserEditForm();

       if($model->load(Yii::$app->request->post())&&$model->validate())
       {

                try{
                    $this->service->edit($model, $id);
                   Yii::$app->session->setFlash('success','Данні було змінено');
                }
                catch (\Exception $exception)
                {
                    Yii::$app->session->setFlash('error',$exception->getMessage());
                }


       }

        $model->phones=$this->phoneRepository->getPhoneStatusNotDeleted($id);

        return $this->render('edit',['model'=> $model,'id'=>$id ]);
    }



    public function actionUploadImage()
    {
        return $this->render('upload-image');
    }
    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
    public  function actionChangePassword()
    {
        $user=User::findOne(Yii::$app->user->identity->getId());

        try {
            $model = new ChangePasswordForm($user);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        try {
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {

                Yii::$app->session->setFlash('success', 'Password Changed!');
            }
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('changePassword', [
            'model' => $model,
        ]);
    }

    public function actionAddPhone()
    {
        $id = Yii::$app->user->id;
        $this->service->addPhone($id);

    }

    public function actionDeletePhone()
    {
        if(Yii::$app->request->isAjax)
           $this->service->deletePhone();

    }


    public function actionAddAvatar()
    {

        if(Yii::$app->request->isAjax){

            $file = $_FILES['file'] ?? null;
            $uploaddir = Yii::getAlias("@frontend/web/avatar/");


            list($type, $ext) = explode( '/', $file['type']);

            if($type =='image')
            {
                $fileName = $this->generateUniqueName() . '.' .$ext;
                $uploadfile = $uploaddir . basename( $fileName);


                if (move_uploaded_file($file['tmp_name'], $uploadfile))
                {
                    $id = Yii::$app->user->id;
                    $this->service->savePhone($id,$fileName);
                    return $fileName;
                }
                else
                {
                    echo "Not uploaded";
                }
            }

        }


    }
    private function generateUniqueName()
    {
        return md5(uniqid());
    }

    public function actionCreditCard()
    {
        $id = Yii::$app->user->id;
        $creditCard  = CreditCard::find()->where(['!=', 'status', CreditCard::CARD_DELETED])->andWhere(array('user_id'=>$id))->all();

        return $this->render('card/creditCard', [
            'creditCard' => $creditCard,
        ]);
    }


    public function actionView($id)
    {
        try {
            return $this->render('card/view', [
                'model' => $this->findModelCard($id),
            ]);
        } catch (NotFoundHttpException $e) {
        }
    }

    public function actionCreateCreditCard()
    {
        $user_id = Yii::$app->user->id;

        $model=new CreditCardForm();
        if ($model->load(Yii::$app->request->post())&&$model->validate()) {
            try {
                $this->service->createCreditCard($model, $user_id);
                return $this->redirect(['/profile/credit-card']);
            }
            catch (\Exception $exception)
            {
                Yii::$app->session->setFlash('error',$exception->getMessage());
            }

        }
        return $this->renderAjax('/profile/card/create', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {

        if(Yii::$app->request->isAjax){
            $cardId = Yii::$app->request->post('idCard');

            $creditCard = $this->findModelCard($cardId);
            $creditCard->status=CreditCard::CARD_DELETED;
            $creditCard->save();

            return $cardId;
        }

    }

    public function actionProduct()
    {
        if(Yii::$app->user->isGuest)
            return $this->goHome();

        $userId = Yii::$app->user->identity->id;
        $query = Goods::find()->filterWhere(['user_id' => $userId])->groupBy(['status' , 'id'])->orderBy(['id' => SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->view->title = Yii::t('menu','My product');
        return $this->render('product', [
            'products' => $products,
            'pages' =>$pages,
        ]);
    }

    public function actionPreference()
    {
        if(Yii::$app->user->isGuest)
            return $this->goHome();

        $userId = Yii::$app->user->identity->id;
        $query = Goods::find()
            ->joinWith('preferences')
            ->filterWhere(['preference.user_id' => $userId])->groupBy(['status' , 'id'])->orderBy(['id' => SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->view->title = Yii::t('menu','My preferences');
        return $this->render('preference', [
            'products' => $products,
            'userId' => $userId,
            'pages' =>$pages,
        ]);
    }

    protected function findModelCard($id)
    {
        if (($model = CreditCard::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
