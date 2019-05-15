<?php
namespace frontend\controllers;

use backend\models\SliderImage;
use common\models\Blog;
use common\models\category\Category;
use common\models\item\Goods;
use common\models\user\VerifyToken;
use common\services\user\SupportRequestService;
use frontend\forms\ProductSearch;
use frontend\forms\user\SupportRequestForm;
use frontend\services\user\UserService;
use Yii;
use yii\base\InvalidParamException;
use yii\base\Module;
use yii\bootstrap4\ActiveForm;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @var UserService
     * @var SupportRequestService
     */
    private $userService;
    private $supportRequestService;

    public function __construct(string $id, Module $module,SupportRequestService $supportRequestService ,UserService $userService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
        $this->supportRequestService = $supportRequestService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $slider=SliderImage::find()->orderBy(['id' => SORT_DESC])->all();
        $blogs = Blog::find()->where(['status'=>Blog::STATUS_POSTED])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
        $query = Goods::find()
            ->where(['status' => Goods::STATUS_AVAILABLE])
            ->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'products' => $products,
            'pages' =>$pages,
            'blogs'=>$blogs,
            'slider'=>$slider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->renderPartial('_logoutForm');
        } else {
            $model->password = '';

            return $this->renderAjax('_formLogin', [
                'model' => $model,
            ]);
        }
    }

    public function actionValidation()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $valid = ActiveForm::validate($model);
            if(count($valid) > 0)
                return $valid;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try{
                $user = $this->userService->saveUserTmp($model);

                $verifyToken = new VerifyToken();
                $verifyToken->user_tmp_id = $user->id;
                $verifyToken->type = VerifyToken::TYPE_EMAIL;
                return $this->renderAjax('_signupCofirmForm', [
                    'model' => $verifyToken,
                ]);
            }catch (\Exception $ex){
                return $this->asJson(['ex' => $ex->getMessage()]);
            }
        }

        return $this->renderAjax('_signupForm', [
            'model' => $model,
        ]);
    }

    public function actionConfirmSignup()
    {
        $verifyToken = new VerifyToken();

        if($verifyToken->load(Yii::$app->request->post()) && $verifyToken->validate()){
            try{
                $this->userService->signupUser($verifyToken);
                return $this->renderPartial('_logoutForm');
            }catch (\Exception $ex){
                return $this->asJson(['ex' => $ex->getMessage()]);
            }
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('menu', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('menu', 'Sorry, we are unable to reset password for the provided email address.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

            Yii::$app->session->setFlash('success', Yii::t('menu', 'New password saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionSendAppeal()
    {
      // var_dump(Yii::$app->session['language']) ;exit;
        $model = new SupportRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try{
                $supportR = $this->supportRequestService->create($model);
                Yii::$app->session->setFlash('success', 'Sent!');
              //  return $this->redirect(['view', 'id' => $subject->id]);
            }
            catch (\Exception $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }

        return $this->render('createSupportRequest', [
            'model' => $model,
        ]);
    }

    public  function actionProductSearch()
    {

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categoriesID = $searchModel->categories();

        $categories = Category::findAll(['id' => $categoriesID]);

        return $this->render('product-search', [
            'searchModel'       => $searchModel,
            'dataProvider'      => $dataProvider,
            'priceDirectionUrl' => $searchModel->getPriceOrderUrl(),
            'dateDirectionUrl'  => $searchModel->getDateOrderUrl(),
            'categories'        => $categories
        ]);
    }
}
