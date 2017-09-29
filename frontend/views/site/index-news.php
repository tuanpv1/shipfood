<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 8/6/2017
 * Time: 3:29 PM
 */
use common\models\News;
use yii\helpers\Url;

$this->title = 'Tin tức làm đẹp';
?>
<div class="row container-kamn">
    <img src="<?= Yii::$app->getUrlManager()->getBaseUrl();  ?>/img/slider/slide5.jpg"
         class="blog-post"
         alt="Monalisa spa không gian sang trọng"
         title="Monalisa spa không gian sang trọng"
         align="right"
         width="100%">
</div>
<!-- Main Container -->
<div id="banners"></div>
<div class="container">
    <h1 class="text-center">
        <?= News::getTypeName($type) . ' Monalisa Spa' ?>
    </h1>
    <div class="row">
        <div class="col-md-9">
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
                                <?php if($type == News::TYPE_DV){ ?>
                                    <p>Giá: <?= $item->price ? News::formatNumber($item->price) : 0 ?> VND</p>
                                    <p>Thời gian sử dụng dich
                                        vụ: <?= $item->honor ? $item->honor . ' Phút' : 'Liên hệ để biết chi tiết' ?> </p>
                                <?php } ?>
                                <p><?= $item->short_description ?></p>
                            </div>
                        </div>
                        <div class="row text-right">
                            <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: <?= $item->view_count ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="glyphicon glyphicon-time"></i> Ngày
                            đăng: <?= date('d-m-Y', $item->created_at) ?>
                        </div>
                    </div>
                    <hr>
                    <?php
                }
            } else {
                echo "Đang cập nhật";
            } ?>

            <div id="last-comment">
            </div>
            <input type="hidden" name="page" id="page"
                   value="<?= sizeof($listNews) - 1 ?>">
            <input type="hidden" name="numberCount" id="numberCount" value="<?= sizeof($listNews) ?>">
            <input type="hidden" name="total" id="total" value="<?= $pages->totalCount ?>">
            <?php if (count($listNews) >= 6) { ?>
                <div style="margin-bottom: 20px" class="view-more-page tac text-center">
                    <button class="btn btn-primary next page-numbers" id="more" onclick="loadMore();">Xem
                        thêm<span></span></button>
                </div>
            <?php } ?>
        </div>
        <?= \frontend\widgets\Header::actiongMenuRight($type) ?>
    </div>
</div>

<!--End Main Container -->

<script type="text/javascript">
    function loadMore() {
        var url = '<?= Url::toRoute(['site/get-news'])?>';
        var type = '<?= $type ?>';
        var page = parseInt($('#page').val()) + 1;
        var total = parseInt(($('#total').val()));
        var numberCount = parseInt($('#numberCount').val()) + 6;
        $.ajax({
            url: url,
            data: {
                'page': page,
                'type': type
            },
            type: "GET",
            crossDomain: true,
            dataType: "text",
            success: function (result) {
                if (null != result && '' != result) {
                    $(result).insertBefore('#last-comment');
                    document.getElementById("page").value = page + 5;
                    document.getElementById("numberCount").value = numberCount;
                    if (numberCount > total) {
                        $('#more').css('display', 'none');
                    }

                    $('#last-comment').html('');
                } else {
                    $('#last-comment').html('');
                }

                return;
            },
            error: function (result) {
                alert('Không thành công. Quý khách vui lòng thử lại sau ít phút.');
                $('#last-comment').html('');
                return;
            }
        });//end jQuery.ajax
    }
</script>
