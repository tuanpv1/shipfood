<?php

/* @var $this yii\web\View */

use common\helpers\CUtils;
use common\models\Banner;
use common\models\News;
use yii\helpers\Url;

$this->title = 'Công ty Shipfood';
?>
<section id="home">
    <div class="banner-container">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="active item"><img src="images/banner-bg3.jpg" alt="banner"/></div>
                <div class="item"><img src="images/banner-bg3.jpg" alt="banner"/></div>
                <div class="item"><img src="images/banner-bg3.jpg" alt="banner"/></div>
            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
        </div>

    </div>

    <div class="container hero-text2">
        <h3>Danh sách đồ ăn cung cấp trong ngày</h3>
    </div>
</section>
<section id="services" class="page-section colord">
    <div class="container">
        <ul class="bxslider">
            <li>
                <img src="images/work/1.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <a href="#" class="btn">Đặt hàng</a>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
            <li>
                <img src="images/work/2.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <button href="#" class="btn">Đặt hàng</button>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
            <li>
                <img src="images/work/3.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <button href="#" class="btn">Đặt hàng</button>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
            <li>
                <img src="images/work/4.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <button href="#" class="btn">Đặt hàng</button>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
            <li>
                <img src="images/work/5.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <button href="#" class="btn">Đặt hàng</button>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
            <li>
                <img src="images/work/6.jpg"/>
                <figcaption class="text-center">
                    <h4>Cơm đùi gà chiên</h4>
                    <button href="#" class="btn btn-danger">Đặt hàng</button>
                    <a href="#">49,000 VND</a>
                </figcaption>
            </li>
        </ul>
    </div>
    <!--/.container-->
</section>
<section id="aboutUs">
    <div class="container">
        <div class="heading text-center">
            <!-- Heading -->
            <h2>SHIPFOOD</h2>
            <p>Chúng tôi luôn đồng hành cùng bạn khi cần chỉ cần thao tác qua app hoặc gọi điện trực tiếp để đặt
                hàng.</p>
        </div>
        <div class="row feature design">
            <div class="area1 columns right">
                <h3>Chất lượng, An toàn, Vệ sinh</h3>
                <p>Định nghĩa mới cho bữa ăn trưa của bạn, sàn phẩm cơm fastfood mang tới cho bạn bữa ăn chất lượng, đảm
                    bảo vệ sinh an toàn thực phẩm, giá cả phù hợp, phục vụ nhanh chóng, chuẩn xác. Tất cả đồ nhựa dùng
                    đựng thực phẩm là nhựa pp, chịu được nhiệt độ -20 độ tới 120 độ. Đảm bảo sức khỏe cho người tiêu
                    dùng. </p>
                <a href="#" class="btn">Đặt hàng</a>
            </div>
            <div class="area2 columns feature-media left"><img src="images/feature-img-1.jpg" alt="" width="100%"></div>
        </div>
    </div>
</section>
<section id="work" class="page-section page">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div id="portfolio">
                    <ul class="filters list-inline">
                        <li><a class="active" data-filter="*" href="#">Danh sách thực đơn</a></li>
                        <li><a data-filter=".photography" href="#">Thực đơn bữa sáng</a></li>
                        <li><a data-filter=".branding" href="#">Thực đơn bữa trưa</a></li>
                        <li><a data-filter=".web" href="#">Đồ uống đi kèm</a></li>
                    </ul>
                    <ul class="items list-unstyled clearfix animated fadeInRight showing" data-animation="fadeInRight"
                        style="position: relative; height: 438px;">
                        <li class="item branding" style="position: absolute; left: 0px; top: 0px;">
                            <figure class="effect-bubba">
                                <img src="images/work/1.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm đùi gà chiên</h2>
                                    <a href="images/work/1.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item photography" style="position: absolute; left: 292px; top: 0px;">
                            <figure class="effect-bubba">
                                <img src="images/work/2.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/2.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item branding" style="position: absolute; left: 585px; top: 0px;">
                            <figure class="effect-bubba">
                                <img src="images/work/3.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/3.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item photography" style="position: absolute; left: 877px; top: 0px;">
                            <figure class="effect-bubba">
                                <img src="images/work/4.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/4.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item photography" style="position: absolute; left: 0px; top: 219px;">
                            <figure class="effect-bubba">
                                <img src="images/work/5.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/5.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item web" style="position: absolute; left: 292px; top: 219px;">
                            <figure class="effect-bubba">
                                <img src="images/work/6.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/6.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item photography" style="position: absolute; left: 585px; top: 219px;">
                            <figure class="effect-bubba">
                                <img src="images/work/7.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/7.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="item web" style="position: absolute; left: 877px; top: 219px;">
                            <figure class="effect-bubba">
                                <img src="images/work/8.jpg" alt="img02"/>
                                <figcaption>
                                    <h2>Cơm sườn xào</h2>
                                    <a href="images/work/8.jpg" class="fancybox">Xem chi tiết</a>
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="app-download" class="page-section">
    <div class="container">
        <div class="heading text-center">
            <!-- Heading -->
            <h2>Tải ứng dụng</h2>
            <p>Ứng dụng hiện đang được hỗ trợ trên hai nên tảng Android và ISO</p>
        </div>
        <!-- Team Member's Details -->
        <div class="team-content">
            <div class="row">

                <div class="col-md-offset-3 col-md-3 col-sm-6 col-xs-12">
                    <!-- Team Member -->
                    <div class="team-member pDark">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img style="height: 50px" class="img-responsive" src="images/androidapp.png" alt="">
                            <img class="img-responsive" src="images/android.png" alt="">
                        </div>
                        <!-- Member Details -->
                        <h4>Android</h4>
                        <!-- Designation -->
                        <div class="team-socials"><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i
                                        class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Team Member -->
                    <div class="team-member pDark">
                        <!-- Image Hover Block -->
                        <div class="member-img">
                            <!-- Image  -->
                            <img style="height: 50px" class="img-responsive" src="images/appstore.png" alt="">
                            <img class="img-responsive" src="images/android.png" alt=""></div>
                        <!-- Member Details -->
                        <h4>ISO</h4>
                        <!-- Designation -->
                        <!--                        <span class="pos">Manager</span>-->
                        <div class="team-socials"><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i
                                        class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.container-->
</section>
