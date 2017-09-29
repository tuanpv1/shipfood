<?php
use backend\assets\AppAsset;
use common\models\Book;
use common\models\News;
use common\models\User;
use common\widgets\Alert;
use common\widgets\Nav;
use common\widgets\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-container-bg-solid page-boxed page-md">
<?php $this->beginBody() ?>
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="container">
        <?php

        NavBar::begin([
            'brandLabel' => '<img width="70px" src="' . Url::to("@web/img/logo_monalisa.png") . '" alt="logo" class="logo-default"/>',
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'class' => 'page-logo'
            ],
            'renderInnerContainer' => true,
            'innerContainerOptions' => [
                'class' => 'container-fluid'
            ],
            'options' => [
                'class' => 'page-header-top',
            ],
            'containerOptions' => [
                'class' => 'top-menu'
            ],
        ]);
        $rightItems = [];
        if (Yii::$app->user->isGuest) {

        } else {
            $count = Book::find()->andWhere(['status'=>Book::STATUS_BOOKED])->count();

            $rightItems[] = [
                'encode' => false,
                'label' => '<img alt="" class="img-circle" src="' . Url::to("@web/img/avatar0.jpg") . '"/>
					<span class="username username-hide-on-mobile">
						 ' . Yii::$app->user->identity->username . '
					</span>',
                'options' => ['class' => 'dropdown dropdown-user dropdown-dark'],
                'linkOptions' => [
                    'data-hover' => "dropdown",
                    'data-close-others' => "true"
                ],
                'url' => 'javascript:;',
                'items' => [
                    [
                        'encode' => false,
                        'label' => '<i class="icon-change"></i> Đổi mật khẩu',
                        'url' => ['/site/change-password'],
                        'linkOptions' => ['data-method' => 'post'],
                    ],

                    [
                        'encode' => false,
                        'label' => '<i class="icon-key"></i> Đăng xuất',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                    ],
                ]
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => $rightItems,
            'activateParents' => true
        ]);
        echo \common\widgets\Badge::widget([]);

        NavBar::end();
        ?>
    </div>
    <!-- END HEADER TOP -->

    <?php
    NavBar::begin([
        'renderInnerContainer' => true,
        'innerContainerOptions' => [
            'class' => 'container '
        ],
        'options' => [
            'class' => 'page-header-menu green',
            'style' => 'display: block; background:#32d3c3;border-bottom: solid 4px #1baa9c;'
        ],
        'containerOptions' => [
            'class' => 'hor-menu'
        ],
        'toggleBtn' => false
    ]);

    $menuItems = [
        [
            'label' => Yii::t('app','QL Thông tin'),
            'url' => 'javascript:;',
            'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
            'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
            'items' => [
                [
                    'encode' => false,
                    'label' => News::getTypeName(News::TYPE_NEWS),
                    'url' => ['news/index', 'type' => News::TYPE_NEWS],
                ],
                [
                    'encode' => false,
                    'label' => News::getTypeName(News::TYPE_CN),
                    'url' => ['news/index', 'type' => News::TYPE_CN],
                ],
                [
                    'encode' => false,
                    'label' => News::getTypeName(News::TYPE_DV),
                    'url' => ['news/index', 'type' => News::TYPE_DV],
                ],
                [
                    'encode' => false,
                    'label' => News::getTypeName(News::TYPE_ABOUT),
                    'url' => ['news/index', 'type' => News::TYPE_ABOUT],
                ],
                [
                    'encode' => false,
                    'label' => News::getTypeName(News::TYPE_KH),
                    'url' => ['news/index', 'type' => News::TYPE_KH],
                ],
            ]
        ],
        [
            'encode' => false,
            'label' => Yii::t('app','QL Banner'),
            'url' => ['banner/index'],
        ],
        [
            'encode' => false,
            'label' => $count?'QL Lịch hẹn <span style="color: red" class="icon-ring">('.$count.')</span>':'QL Lịch hẹn',
            'url' => ['book/index'],
        ],
        [
            'encode' => false,
            'label' => Yii::t('app','Cấu hình'),
            'url' => ['info-public/index'],
        ],
        [
            'label' => Yii::t('app','QL Phân quyền & tài khoản'),
            'url' => 'javascript:;',
            'options' => ['class' => 'menu-dropdown mega-menu-dropdown'],
            'linkOptions' => ['data-hover' => 'megamenu-dropdown', 'data-close-others' => 'true'],
            'items' => [
                [
                    'encode' => false,
                    'label' => Yii::t('app','QL Tài khoản'),
                    'url' => ['user/index', "type" => User::TYPE_ADMIN],
                ],
                [
                    'encode' => false,
                    'label' => Yii::t('app','QL Quyền'),
                    'url' => ['rbac-backend/permission'],
                    'require_auth' => true,
                ],
                [
                    'encode' => false,
                    'label' => Yii::t('app','QL Nhóm quyền'),
                    'url' => ['rbac-backend/role'],
                ],
            ]
        ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
        'activateParents' => true
    ]);
    NavBar::end();
    ?>


</div>

<style>
    .hor-menu ul li {
        border-left: solid 1px rgba(255, 255, 255, 0.3);
    }

    .hor-menu li:last-child {
        border-right: solid 1px rgba(255, 255, 255, 0.3);
    }

    .hor-menu ul li a {
        color: white !important;
    }

    .hor-menu ul li a:hover {
        background-color: #1baa9c !important;
    }

</style>
<!-- BEGIN CONTAINER -->
<div class="page-container">

    <div class="page-content-wrapper">
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container-fluid">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'page-breadcrumb breadcrumb'
                    ],
                    'itemTemplate' => "<li>{link}<i class=\"fa fa-circle\"></i></li>\n",
                    'activeItemTemplate' => "<li class=\"active\">{link}</li>\n"
                ]) ?>
                <?= Alert::widget() ?>
                <?= \common\widgets\Toast::widget(['view' => $this]) ?>
                <div class="page-content-inner">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
    </div>
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container-fluid">
        <p><b>&copy;Copyright 2017 </b>. CMS by TP.</p>
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
