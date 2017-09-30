<?php
use common\models\News;
use yii\helpers\Url;

?>
<header class="header">
    <div class="container">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse"
                        data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand scroll-top logo  animated bounceInLeft">
                            <img style="height: 80px;" src="images/logo.png"/>
                </a>
            </div>
            <!--/.navbar-header-->
            <div id="main-nav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="mainNav">
                    <li class="active" id="firstLink"><a href="#home" class="scroll-link">Trang chủ</a></li>
                    <li><a href="#services" class="scroll-link">Bữa sáng</a></li>
                    <li><a href="#aboutUs" class="scroll-link">Bữa trưa</a></li>
                    <li><a href="#app-download" class="scroll-link">Tải ứng dụng</a></li>
                    <li><a href="#contactUs" class="scroll-link">Liên hệ</a></li>
                </ul>
            </div>
            <!--/.navbar-collapse-->
        </nav>
        <!--/.navbar-->
    </div>
    <!--/.container-->
</header>
<!--/.header-->
<div id="#top"></div>