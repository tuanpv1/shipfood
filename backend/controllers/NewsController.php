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
    public function actionIndex($type = News::TYPE_NEWS)
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
        $thumbnailInit = [];
        $imageDesInit = [];
        $thumbnailPreview = [];
        $imageDesPreview = [];
        if ($model->load(Yii::$app->request->post())) {
            $thumbnails = UploadedFile::getInstances($model, 'thumbnail');
            $imageDes = UploadedFile::getInstances($model, 'image_des');
            $images = [];
            if (count($thumbnails) > 0) {
                foreach ($thumbnails as $image) {
                    $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                    if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_news') . "/" . $file_name)) {
                        $new_file['name'] = $file_name;
                        $new_file['type'] = News::IMAGE_TYPE_THUMBNAIL;
                        $new_file['size'] = $image->size;
                        $images[] = $new_file;
                    }
                }

            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Ảnh đại diện không được để trống'));
                return $this->render('create', [
                    'model' => $model,
                    'thumbnailInit' => $thumbnailInit,
                    'thumbnailPreview' => $thumbnailPreview,
                    'imageDesInit' => $imageDesInit,
                    'imageDesPreview' => $imageDesPreview,
                    'type' => $type,
                ]);
            }
            if (count($imageDes) > 0) {
                foreach ($imageDes as $image) {
                    $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                    if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_news') . "/" . $file_name)) {
                        $new_file['name'] = $file_name;
                        $new_file['type'] = News::IMAGE_TYPE_DES;
                        $new_file['size'] = $image->size;
                        $images[] = $new_file;
                    }
                }
            }
            $old_images = News::convertJsonToArray($model->images);
            $model->images = Json::encode(ArrayHelper::merge($old_images, $images));
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
                    'thumbnailInit' => $thumbnailInit,
                    'thumbnailPreview' => $thumbnailPreview,
                    'imageDesInit' => $imageDesInit,
                    'imageDesPreview' => $imageDesPreview,
                    'type' => $type,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'thumbnailInit' => $thumbnailInit,
                'thumbnailPreview' => $thumbnailPreview,
                'imageDesInit' => $imageDesInit,
                'imageDesPreview' => $imageDesPreview,
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
        $thumbnailInit = [];
        $imageDesInit = [];
        $thumbnailPreview = [];
        $imageDesPreview = [];
        $images = News::convertJsonToArray($model->images);
        $old_images = News::convertJsonToArray($model->images);
        foreach ($images as $key => $row) {
            $key = $key + 1;
            $urlDelete = Yii::$app->urlManager->createAbsoluteUrl(['/news/delete-image', 'name' => $row['name'], 'type' => $row['type'], 'id' => $id]);
            $name = $row['name'];
            $type = $row['type'];
            $value = ['caption' => $name, 'width' => '120px', 'url' => $urlDelete, 'key' => $name];
            $host_file = ((strpos($row['name'], 'http') !== false) || (strpos($row['name'], 'https') !== false)) ? $row['name'] : Yii::getAlias('@web/upload/image_news/') . $row['name'];
            $preview = Html::img($host_file, ['class' => 'file-preview-image']);
            switch ($row['type']) {
                case (News::IMAGE_TYPE_THUMBNAIL):
                    $thumbnailPreview[] = $preview;
                    $thumbnailInit[] = $value;
                    break;
                case (News::IMAGE_TYPE_DES):
                    $imageDesInit[] = $value;
                    $imageDesPreview[] = $preview;
                    break;
            }
        }
        $errors = $model->errors;
        if ($model->load(Yii::$app->request->post())) {

            $thumbnails = UploadedFile::getInstances($model, 'thumbnail');
            $imageDes = UploadedFile::getInstances($model, 'image_des');
            $images = [];
            if (count($thumbnails) > 0) {
                foreach ($thumbnails as $image) {
                    $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                    if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_news') . "/" . $file_name)) {
                        $new_file['name'] = $file_name;
                        $new_file['type'] = News::IMAGE_TYPE_THUMBNAIL;
                        $new_file['size'] = $image->size;
                        $images[] = $new_file;
                    }
                }

            }
            if (count($imageDes) > 0) {
                foreach ($imageDes as $image) {
                    $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image->extension;
                    if ($image->saveAs(Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_news') . "/" . $file_name)) {
                        $new_file['name'] = $file_name;
                        $new_file['type'] = News::IMAGE_TYPE_DES;
                        $new_file['size'] = $image->size;
                        $images[] = $new_file;
                    }
                }
            }
            $model->images = Json::encode(ArrayHelper::merge($old_images, $images));
//            echo"<pre>";print_r($model->image);die();
            if ($model->update(false)) {
                Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
//                echo"<pre>";print_r($errors);die();
                Yii::$app->session->setFlash('error', 'Cập nhật không thành công!');
                return $this->render('update', [
                    'model' => $model,
                    'thumbnailInit' => $thumbnailInit,
                    'thumbnailPreview' => $thumbnailPreview,
                    'imageDesInit' => $imageDesInit,
                    'imageDesPreview' => $imageDesPreview,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'thumbnailInit' => $thumbnailInit,
                'thumbnailPreview' => $thumbnailPreview,
                'imageDesInit' => $imageDesInit,
                'imageDesPreview' => $imageDesPreview,
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


    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $new_id = Yii::$app->request->get('id');
        $name = Yii::$app->request->get('name');

        if (!$new_id || !$name) {
            return [
                'success' => false,
                'message' => 'Thiếu tham số!',
                'error' => 'Thiếu tham số!',
            ];
        }
        $content = News::findOne(['id' => $new_id]);
        if (!$content) {
            return [
                'success' => false,
                'message' => 'Không thấy nội dung!',
                'error' => 'Không thấy nội dung!',
            ];
        } else {
            $index = -1;
            $images = News::convertJsonToArray($content->images);
            Yii::trace($images);
            foreach ($images as $key => $row) {
                if ($row['name'] == $name) {
                    $index = $key;
                }
            }
            if ($index == -1) {
                return [
                    'success' => false,
                    'message' => 'Không thấy ảnh!',
                    'error' => 'Không thấy ảnh!',
                ];
            } else {
                array_splice($images, $index, 1);
                Yii::trace($images);
                $content->images = Json::encode($images);
                if ($content->save(false)) {
                    $tmp = Yii::getAlias('@webroot') . "/" . Yii::getAlias('@image_news') . "/";
                    if (file_exists($tmp . $name)) {
                        unlink($tmp . $name);
                    }
                    return [
                        'success' => true,
                        'message' => 'Xóa ảnh thành công',
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => $content->getErrors(),
                    ];
                }
            }
        }
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
