<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 8/6/2017
 * Time: 3:29 PM
 */
use common\models\News;
use yii\helpers\Url;

$this->title = 'Tin tức';
?>
<!-- Main Container -->
<section class="abouts">
    <div class="container">
        <div class="row">
            <div class="abouts_content">
                <h4 class="text-center">SHIPFOOD</h4>
                <div class="row">
                    <div class="col-md-9">
                        <?php if ($listNews) {
                            foreach ($listNews as $item) {
                                /** @var News $item */
                                ?>
                                <div class="blog-post">
                                    <h5>
                                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                                            <i class="fa fa-file-text"></i>
                                            <?= $item->title ?>
                                        </a>
                                    </h5><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                                                <img src="<?= News::getFirstImageLinkTP($item->images) ?>"
                                                     alt="<?= $item->title ?>"
                                                     title="<?= $item->title ?>"
                                                     align="right" width="100%" class="blog-image">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $item->short_description ?></p>
                                        </div>
                                    </div>
                                    <div class="row text-right">
                                        <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: <?= $item->view_count ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="glyphicon glyphicon-time"></i> Ngày
                                        đăng: <?= date('d-m-Y', $item->created_at) ?>
                                    </div>
                                </div>
                                <hr>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="blog-post">
                                <a href="#"><h5><i class="fa fa-file-text"></i> Hoạt động ngày 10/11/2017</h5></a><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="#">
                                            <img src="images/p1.png" alt="Chất lượng, An toàn, Vệ sinh"
                                                 title="Chất lượng, An toàn, Vệ sinh"
                                                 align="right" height="200px" class="blog-image">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus
                                            asperiores aut beatae corporis dicta dignissimos dolorem ea eos error facere
                                            fuga illum incidunt ipsum itaque laboriosam laudantium libero molestias
                                            natus necessitatibus nesciunt non nulla obcaecati officia, optio provident
                                            quasi qui quis quisquam quod rem repudiandae rerum sed sunt tempora tempore
                                            voluptas! Accusamus dicta mollitia obcaecati odit, quisquam sint
                                            voluptate?</p>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: 0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="glyphicon glyphicon-time"></i> Ngày
                                    đăng: 01-10-2017
                                </div>
                            </div>
                            <hr>
                            <div class="blog-post">
                                <a href="#"><h5><i class="fa fa-file-text"></i> Hoạt động ngày 10/11/2017</h5></a><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="#">
                                            <img src="images/p1.png" alt="Chất lượng, An toàn, Vệ sinh"
                                                 title="Chất lượng, An toàn, Vệ sinh"
                                                 align="right" height="200px" class="blog-image">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus
                                            asperiores aut beatae corporis dicta dignissimos dolorem ea eos error facere
                                            fuga illum incidunt ipsum itaque laboriosam laudantium libero molestias
                                            natus necessitatibus nesciunt non nulla obcaecati officia, optio provident
                                            quasi qui quis quisquam quod rem repudiandae rerum sed sunt tempora tempore
                                            voluptas! Accusamus dicta mollitia obcaecati odit, quisquam sint
                                            voluptate?</p>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: 0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="glyphicon glyphicon-time"></i> Ngày
                                    đăng: 01-10-2017
                                </div>
                            </div>
                            <hr>
                            <div class="blog-post">
                                <a href="#"><h5><i class="fa fa-file-text"></i> Hoạt động ngày 10/11/2017</h5></a><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="#">
                                            <img src="images/p1.png" alt="Chất lượng, An toàn, Vệ sinh"
                                                 title="Chất lượng, An toàn, Vệ sinh"
                                                 align="right" height="200px" class="blog-image">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus
                                            asperiores aut beatae corporis dicta dignissimos dolorem ea eos error facere
                                            fuga illum incidunt ipsum itaque laboriosam laudantium libero molestias
                                            natus necessitatibus nesciunt non nulla obcaecati officia, optio provident
                                            quasi qui quis quisquam quod rem repudiandae rerum sed sunt tempora tempore
                                            voluptas! Accusamus dicta mollitia obcaecati odit, quisquam sint
                                            voluptate?</p>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <i class="glyphicon glyphicon-eye-open"></i> Lượt xem: 0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="glyphicon glyphicon-time"></i> Ngày
                                    đăng: 01-10-2017
                                </div>
                            </div>
                            <hr>

                            <?php
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
                    <?= \frontend\widgets\Header::actiongMenuRight() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function loadMore() {
        var url = '<?= Url::toRoute(['site/get-news'])?>';
        var page = parseInt($('#page').val()) + 1;
        var total = parseInt(($('#total').val()));
        var numberCount = parseInt($('#numberCount').val()) + 6;
        $.ajax({
            url: url,
            data: {
                'page': page,
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
