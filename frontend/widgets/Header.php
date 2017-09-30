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
}