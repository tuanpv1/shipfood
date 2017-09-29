<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 1/17/2017
 * Time: 9:21 AM
 */
use common\models\News;
use yii\helpers\Url;

?>
<?php if ($listNews) {
    foreach ($listNews as $item) {
        /** @var News $item */
        ?>
        <div class="blog-post">
            <h2>
                <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                    <i class="fa fa-file-text"></i>
                    <?= $item->title ?>
                </a>
            </h2><br>
            <div class="row">
                <div class="col-md-4">
                    <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                        <img src="<?= News::getFirstImageLinkTP($item->images) ?>" alt="<?= $item->title ?>"
                             title="<?= $item->title ?>"
                             align="right" width="100%" class="blog-image">
                    </a>
                </div>
                <div class="col-md-8">
                    <p>Giá: <?= $item->price?News::formatNumber($item->price):0 ?> VND</p>
                    <p>Thời gian sử dụng dich vụ: <?= $item->honor?$item->honor.' Phút':'Liên hệ để biết chi tiết' ?> </p>
                    <p><?= $item->short_description ?></p>
                </div>
            </div>
            <div class="row text-right">
                <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: <?= $item->view_count ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="glyphicon glyphicon-time"></i> Ngày đăng: <?= date('d-m-Y', $item->created_at) ?>
            </div>
        </div>
        <hr>
        <?php
    }
} else {
    echo "Đang cập nhật";
} ?>
