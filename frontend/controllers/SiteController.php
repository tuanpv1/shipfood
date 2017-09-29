<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\Email;
use common\models\IpAddressTable;
use common\models\TableAgency;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AffiliateCompany;
use common\models\Banner;
use common\models\LoginForm;
use common\models\News;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
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
     * @inheritdoc
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
        $listBanner = Banner::findAll(['status' => Banner::STATUS_ACTIVE]);

        $listCn = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_CN])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(4)
            ->all();

        $gioithieu = News::find()->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_ABOUT])
            ->orderBy(['updated_at' => SORT_DESC])->one();

        $listDv = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_DV])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(20)
            ->all();

        return $this->render('index', [
            'listCn' => $listCn,
            'gioithieu' => $gioithieu,
            'listDv' => $listDv,
            'listBanner' => $listBanner,
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
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
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
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
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
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
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
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRegisterEmail()
    {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $model = new Email();
        $model->email = $email;
        $model->phone = $phone;
        $model->status = Email::STATUS_ACTIVE;
        if ($model->save(false)) {
            $content = "Khách hàng có địa chỉ email: " . $email . ", số điện thoại: " . $phone . " vừa đăng kí nhận tư vấn";
            $to = Yii::$app->params['emailSend'];
            $subject = "Vừa có khách hàng đăng kí nhận tư vấn";
            if ($this->sendMail($to, $subject, $content)) {
                $message = Yii::t('app', 'Đăng kí nhận tư vấn thành công.');
                return Json::encode(['success' => true, 'message' => $message]);
            } else {
                $message = Yii::t('app', 'khong gui dc mail.');
                return Json::encode(['success' => true, 'message' => $message]);
            }
        } else {
            $message = Yii::t('app', 'Đăng kí nhận tư vấn không thành công.');
            return Json::encode(['success' => false, 'message' => $message]);
        }
    }

    public function actionNews($type = News::TYPE_NEWS)
    {
        $cat = null;
        $listNews = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE]);
        if ($type == News::TYPE_NEWS) {
            $listNews->andWhere(['type' => News::TYPE_NEWS]);
        } elseif ($type == News::TYPE_DV) {
            $listNews->andWhere(['type' => News::TYPE_DV]);
        } elseif ($type == News::TYPE_CN) {
            $listNews->andWhere(['type' => News::TYPE_CN]);
        }

        $listNews->orderBy(['created_at' => SORT_DESC]);
        $countQuery = clone $listNews;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pageSize = 6;
        $pages->setPageSize($pageSize);
        $models = $listNews->offset($pages->offset)
            ->limit(6)->all();

        return $this->render('index-news', [
            'listNews' => $models,
            'pages' => $pages,
            'type' => $type,
            'cat' => $cat,
        ]);

    }

    public function actionDetailNews($id)
    {
        $model = News::findOne(['id' => $id]);
        $view_old = $model->view_count;
        if($view_old == ''){
            $view_old = 0;
        }
        $model->view_count = $view_old + 1;
        $model->update();
        return $this->render('detail-news', [
            'new' => $model
        ]);
    }

    public function actionInvestment()
    { // loi ich dau tu
        $this->layout = 'main-page.php';
        $listNews = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_COMMON])
            ->orderBy(['updated_at' => SORT_DESC]);
        $countQuery = clone $listNews;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pageSize = 6;
        $pages->setPageSize($pageSize);
        $models = $listNews->offset($pages->offset)
            ->limit(6)->all();
        $this->layout = 'main-page.php';
        return $this->render('investment', [
            'listNews' => $models,
            'pages' => $pages,
        ]);
    }

    public function actionDistribution()
    { // he thong phan phoi
        $this->layout = 'main-page.php';
        $listDistribution = TableAgency::find()
            ->andWhere(['status' => TableAgency::STATUS_ACTIVE])
            ->orderBy(['updated_at' => SORT_DESC])->all();
        return $this->render('distribution', [
            'model' => $listDistribution,
        ]);
    }

    public function actionGetInvestment()
    {

        $page = $this->getParameter('page');

        $listNews = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_COMMON])
            ->orderBy(['created_at' => SORT_DESC]);
        $models = $listNews->offset($page)
            ->limit(6)->all();
        return $this->renderPartial('_investment', [
            'listNews' => $models,
        ]);

    }

    public function actionGetNews()
    {

        $page = $this->getParameter('page');
        $type = $this->getParameter('type');

        $listNews = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => $type])
            ->orderBy(['created_at' => SORT_DESC]);
        $models = $listNews->offset($page)
            ->limit(6)->all();
        return $this->renderPartial('_news', [
            'listNews' => $models,
        ]);

    }

    public function getParameter($param_name, $default = null)
    {
        return \Yii::$app->request->get($param_name, $default);
    }

    protected function sendMail($to, $subject, $content)
    {
        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($to)
            ->setSubject($subject)
            ->setTextBody($content)
            ->send();
    }

    public function actionSaveBook(){
        $full_name = ucwords($_POST['full_name']);
        $phone = $_POST['phone'];
        $id_dv = $_POST['id_dv'];
        $start_time = $_POST['start_time'];
        $old = $_POST['old'];

        $model = new Book();
        $model->full_name = $full_name;
        $model->phone = $phone;
        $model->time_start = strtotime($start_time);
        $model->id_dv = $id_dv;
        $model->status = Book::STATUS_BOOKED;
        $model->old = $old;
        if(!$model->save()){
            Yii::info($model->getErrors());
            return Json::encode(['success' => false, 'message' => 'Không đặt lịch hẹn thành công']);
        }
        return Json::encode(['success' => true, 'message' => 'Chúc mừng khách hàng '.$full_name.' đã đặt lịch hẹn thành công']);
    }
}
