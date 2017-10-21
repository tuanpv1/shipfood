<?php

namespace backend\controllers;

use Yii;
use common\models\InfoPublic;
use common\models\InfoPublicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InfoPublicController implements the CRUD actions for InfoPublic model.
 */
class InfoPublicController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all InfoPublic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = InfoPublic::ID_DEFAULT;
        $model =  InfoPublic::findOne($id);
        if($model){
            return $this->render('view', [
                'model' => $model
            ]);
        }else{
            return $this->redirect(['info-public/create']);
        }

    }

    /**
     * Displays a single InfoPublic model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InfoPublic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoPublic();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post())) {
            $image_header = UploadedFile::getInstance($model, 'image_header');
            if ($image_header) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_header->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_header->saveAs($tmp . $file_name)) {
                    $model->image_header = $file_name;
                }
            }
            $image_android = UploadedFile::getInstance($model, 'image_android');
            if ($image_android) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_android->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_android->saveAs($tmp . $file_name)) {
                    $model->image_android = $file_name;
                }
            }
            $image_ios = UploadedFile::getInstance($model, 'image_ios');
            if ($image_ios) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_ios->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_ios->saveAs($tmp . $file_name)) {
                    $model->image_ios = $file_name;
                }
            }
            $model->status = InfoPublic::STATUS_ACTIVE;
            if ($model->save(false)) {
                \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Thêm mới thông tin thành công'));
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Thêm mới thông tin không thành thành công'));
                return $this->render('create', ['model' => $model]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InfoPublic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image_header = $model->image_header;
        $old_image_android = $model->image_android;
        $old_image_ios = $model->image_ios;
        if ($model->load(Yii::$app->request->post())) {
            $image_header = UploadedFile::getInstance($model, 'image_header');
            if ($image_header) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_header->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_header->saveAs($tmp . $file_name)) {
//                    if(file_exists($tmp.$old_image_header)){
//                        unlink($tmp.$old_image_header);
//                    }
                    $model->image_header = $file_name;
                }
            }else{
                $model->image_header = $old_image_header;
            }

            $image_android = UploadedFile::getInstance($model, 'image_android');
            if ($image_android) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_android->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_android->saveAs($tmp . $file_name)) {
//                    if(file_exists($tmp.$old_image_android)){
//                        unlink($tmp.$old_image_android);
//                    }
                    $model->image_android = $file_name;
                }
            }else{
                $model->image_android = $old_image_android;
            }

            $image_ios = UploadedFile::getInstance($model, 'image_ios');
            if ($image_ios) {
                $file_name = Yii::$app->user->id . '.' . uniqid() . time() . '.' . $image_ios->extension;
                $tmp = Yii::getAlias('@backend') . '/web/' . Yii::getAlias('@image_banner') . '/';
                if (!file_exists($tmp)) {
                    mkdir($tmp, 0777, true);
                }
                if ($image_ios->saveAs($tmp . $file_name)) {
//                    if(file_exists($tmp.$old_image_ios)){
//                        unlink($tmp.$old_image_ios);
//                    }
                    $model->image_ios = $file_name;
                }
            }else{
                $model->image_ios = $old_image_ios;
            }
            if ($model->update(false)) {
                \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Cập nhật thông tin thành công'));
                return $this->redirect(['index']);
            } else {
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Cập nhật thông tin không thành thành công'));
                return $this->render('create', ['model' => $model]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InfoPublic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        throw new NotFoundHttpException('The requested page does not exist.');
//        $model = $this->findModel($id);
//        $model->status = InfoPublic::STATUS_DELETED;
//        if($model->update(false)){
//            \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Xóa thông tin thành công'));
//            return $this->redirect(['index']);
//        }else{
//            \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Xóa thông tin không thành thành công'));
//            return $this->render('view', ['model' => $model]);
//        }
    }

    /**
     * Finds the InfoPublic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoPublic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoPublic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
