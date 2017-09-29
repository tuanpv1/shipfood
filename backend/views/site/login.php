<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form' ]); ?>
    <div class="form-group">

        <?= $form->field($model, 'username', [
                'addon' => [
                    'prepend' => ['content' => '<i class="fa fa-user"></i>','options'=>['style'=>'background-color:#ffffff !important']],

                ],
                'showLabels' => false,

            ]
        )->textInput(['class'=>'form-control placeholder-no-fix','autocomplete'=>'off','placeholder' => $model->getAttributeLabel('username')])
        ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'password', [
                'addon' => ['prepend' => ['content' => '<i class="fa fa-lock"></i>','options'=>['style'=>'background-color:#ffffff !important']]],
                'showLabels' => false,

            ]
        )->passwordInput(['class'=>'form-control placeholder-no-fix','autocomplete'=>'off','placeholder' => $model->getAttributeLabel('password')])
        ?>
    </div>

    <div class="form-actions">
        <label class="checkbox">
            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'checker']) ?>
        </label>
        <?= Html::submitButton('Đăng nhập <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn green-haze pull-right', 'name' => 'login-button']) ?>
    </div>
<?php ActiveForm::end(); ?>