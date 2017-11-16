<?php

namespace backend\controllers;

use backend\models\Image;
use common\auth\filters\NewsAuth;
use common\auth\filters\Yii2Auth;
use common\models\NewsCategoryAsm;
use common\models\NewsVillageAsm;
use common\models\User;
use Exception;
use kartik\helpers\Html;
use Yii;
use common\models\News;
use common\models\NewsSearch;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'auth' => [
                'class' => Yii2Auth::className(),
                'autoAllow' => false,
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex($type = News::TYPE_ABOUT)
    {
        if ($type == News::TYPE_ABOUT) {
            $model = News::findOne(['status'=>News::STATUS_ACTIVE,'type'=>News::TYPE_ABOUT]);
            if($model){
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                return $this->redirect(['create','type'=>News::TYPE_ABOUT]);
            }
        } else {
            $searchModel = new NewsSearch();
            $params = Yii::$app->request->queryParams;

            $params['NewsSearch']['type'] = $type;

            $dataProvider = $searchModel->search($params);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'type' => $type,
            ]);
        }
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $imageModel = new Image();
        $images = $model->getImagesNews();
        $imageProvider = new ArrayDataProvider([
            'key' => 'name',
            'allModels' => $images,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('view', [
            'model' => $model,
            'active' => 1,
            'imageModel' => $imageModel,
            'imageProvider' => $imageProvider,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new News();
        $model->setScenario('create');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $image_display = UploadedFile::getInstance($model, 'images');
            if ($image_display) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_display->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_news') . '/';
                if ($image_display->saveAs($tmp . $file_name)) {
                    $model->images = $file_name;
                }
            }
            $model->type = $type;
            $model->user_id = Yii::$app->user->id;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Thêm thành công!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Thêm không thành công!');
                Yii::$app->getErrorHandler();
                return $this->render('create', [
                    'model' => $model,
                    'type' => $type,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'type' => $type,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_images = $model->images;
        if ($model->load(Yii::$app->request->post())) {
            $image_display = UploadedFile::getInstance($model, 'images');
            if ($image_display) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_display->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_news') . '/';
                if ($image_display->saveAs($tmp . $file_name)) {
                    if(file_exists($tmp . $old_images)){
//                        unlink($tmp . $old_images);
                    }
                    $model->images = $file_name;
                }
            }else{
                $model->images = $old_images;
            }
            if ($model->update(false)) {
                Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
//                echo"<pre>";print_r($errors);die();
                Yii::$app->session->setFlash('error', 'Cập nhật không thành công!');
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $type = $model->type;
        if ($model->status == News::STATUS_ACTIVE) {
            Yii::$app->session->setFlash('error', 'Không được xóa đang ở trạng thái hoạt động!');
            return $this->redirect(['view', 'id' => $id]);
        }
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Xóa thành công');
        return $this->redirect(['index','type'=>$type]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionUpdateStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        if ($model->status == News::STATUS_ACTIVE) {
            $model->published_at = time();
        }
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Cập nhật trạng thái thành công!');
        } else {
            Yii::$app->session->setFlash('error', 'Lỗi hệ thống, vui lòng thử lại!');
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }
}
