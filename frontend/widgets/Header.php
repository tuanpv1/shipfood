<?php

namespace frontend\widgets;

use common\models\AffiliateCompany;
use common\models\Book;
use common\models\Category;
use common\models\InfoPublic;
use common\models\News;
use frontend\models\ContactUser;
use frontend\models\SignupForm;
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
        $info = InfoPublic::findOne(InfoPublic::ID_DEFAULT);
        $model = new Book();
        return $this->render('header', [
            'info' => $info,
            'model' => $model,
        ]);
    }

    public static function actiongMenuRight()
    {
        $listFood = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['IN', 'type' => [News::TYPE_FOOD_MORNING, News::TYPE_FOOD_LUNCH]])
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();
        $listDrink = News::find()
            ->andWhere(['status' => News::STATUS_ACTIVE])
            ->andWhere(['=', 'type' => [News::TYPE_DRINK]])
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)
            ->all();
        $st = new Header();
        return $st->render('menu-right', [
            'listDrink' => $listDrink,
            'listFood' => $listFood,
        ]);
    }
}