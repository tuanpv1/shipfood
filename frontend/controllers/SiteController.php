<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\Email;
use common\models\InfoPublic;
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
use yii\web\Response;
use yii\web\UploadedFile;

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
//        $listBanner = Banner::findAll(['status' => Banner::STATUS_ACTIVE]);

        $listVegetable = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['IN', 'type', [News::TYPE_VEGETABLES_LK, News::TYPE_VEGETABLES_SX]])
            ->orderBy(['updated_at' => SORT_DESC])
            ->all();

        $gioithieu = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_ABOUT])
            ->orderBy(['updated_at' => SORT_DESC])
            ->one();

        $listDrink = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['type' => News::TYPE_DRINK])
            ->orderBy(['updated_at' => SORT_DESC])
            ->all();

        $listFood = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['IN', 'type', [News::TYPE_FOOD_LUNCH, News::TYPE_FOOD_MORNING]])
            ->orderBy(['updated_at' => SORT_DESC])
            ->all();

        $info = InfoPublic::findOne(InfoPublic::ID_DEFAULT);

        return $this->render('index', [
            'listVegetable' => $listVegetable,
            'gioithieu' => $gioithieu,
            'listFood' => $listFood,
            'info' => $info,
            'listDrink' => $listDrink,
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

    public function actionNews()
    {
        $cat = null;
        $listNews = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['=', 'type', News::TYPE_NEWS]);
//
        $listNews->orderBy(['updated_at' => SORT_DESC]);
        $countQuery = clone $listNews;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pageSize = 6;
        $pages->setPageSize($pageSize);
        $models = $listNews->offset($pages->offset)
            ->limit(6)->all();

        return $this->render('index-news', [
            'listNews' => $models,
            'pages' => $pages,
        ]);

    }

    public function actionDetailNews($id)
    {
        $model = News::findOne(['id' => $id]);
        $view_old = $model->view_count;
        if ($view_old == '') {
            $view_old = 0;
        }
        $model->view_count = $view_old + 1;
        $model->update();
        return $this->render('detail-news', [
            'new' => $model
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

    public function actionBook()
    {
        $model = new Book();
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'file');
            if ($image) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_file') . '/';
                if ($image->saveAs($tmp . $file_name)) {
                    $model->file = $file_name;
                }
            }
            $model->time_start = time();
            $model->status = Book::STATUS_BOOKED;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Ứng tuyển thành công');
//                return Json::encode(['success' => true, 'message' => 'Chúc mừng khách hàng ' . $full_name . ' đã đặt lịch hẹn thành công']);
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Ứng tuyển không thành công');
                Yii::info($model->getErrors());
                return $this->redirect(['site/index']);
//                return Json::encode(['success' => false, 'message' => 'Không đặt lịch hẹn thành công']);
            }
        }
    }

    public function actionGetDetailModal(){
        $id = $_POST['idNew'];
        $model = News::findOne($id);
        if ($model) {
            $data = $this->renderAjax('_body-modal', [
                'model' => $model,
            ]);
            $success = true;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => $success, 'data' => $data];

        } else {
            $success = false;
            $message = 'Không tồn tại nội dung';
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => $success, 'data' => $message];
    }
}
