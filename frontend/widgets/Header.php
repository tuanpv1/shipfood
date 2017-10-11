<?php

namespace frontend\widgets;

use common\models\AffiliateCompany;
use common\models\Book;
use common\models\Category;
use common\models\InfoPublic;
use common\models\News;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: HungChelsea
 * Date: 13-Jan-17
 * Time: 7:51 PM
 */
class Header extends Widget
{
    public function run()
    {
        $link_image_logo = '';
        return $this->render('header', [
            'link_image_logo' => $link_image_logo,
        ]);
    }

    public static function actiongMenuRight()
    {
//        $listDv = News::find()
//            ->andWhere(['status' => News::STATUS_ACTIVE])
//            ->andWhere(['type' => News::TYPE_DV])
//            ->limit(5)
//            ->all();
        $listQt = null;
//        if ($type == News::TYPE_NEWS) {
//            $listQt = News::find()
//                ->andWhere(['type' => News::TYPE_DV])
//                ->andWhere(['status' => News::STATUS_ACTIVE])
//                ->limit(6)->all();
//        } elseif ($type == News::TYPE_DV) {
//            $listQt = News::find()
//                ->andWhere(['type' => News::TYPE_CN])
//                ->andWhere(['status' => News::STATUS_ACTIVE])
//                ->limit(6)->all();
//        } elseif ($type == News::TYPE_CN) {
//            $listQt = News::find()
//                ->andWhere(['type' => News::TYPE_NEWS])
//                ->andWhere(['status' => News::STATUS_ACTIVE])
//                ->limit(6)->all();
//        }
        $st = new Header();
        return $st->render('menu-right', [
//            'listDv' => $listDv,
            'listQt' => $listQt,
        ]);
    }
}