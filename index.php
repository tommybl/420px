<?php 
    include 'controllers/indexCtrl.php';
    include 'views/header.php';
?>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">420px</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-right: 10px">
                    <span style="position: relative; top: 16px"><div class="fb-share-button" data-href="./index.php" data-layout="button" style="display: inline"></div></span>
                </li>
                <li style="margin-right: 8px">
                    <span style="position: relative; top: 16px"><div class="g-plus" data-action="share" data-annotation="none" data-href="./index.php"  style="display: inline-block"></div></span>
                </li>
                <li style="margin-right: 20px">
                    <span style="position: relative; top: 16px"><a href="//fr.pinterest.com/pin/create/button/?url=http://localhost:8080/420px/" data-pin-do="buttonBookmark" data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a></span>
                </li>
                <li>
                    <a href="./feeds/rss-xml.php" target="_blank"><i class="fa fa-rss-square fa-lg" style="color: #f05f40"></i> &nbsp; GLOBAL RSS</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">Get started</a>
                </li>
                <li>
                    <a class="page-scroll" href="#portfolio">Explore <span id="global-nb-pics"></span> pics</a>
                </li>

                <?php

                if (!isset($_SESSION['user'])) {
                    echo
                    '<li>
                    <a class="page-scroll" href="#log-in">Log in</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#sign-up">Sign up</a>
                    </li>';
                }

                ?>

                <li>
                    <a class="page-scroll" href="#contact">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="search.php">Search</a>
                </li>

                <?php

                if (isset($_SESSION['user'])) {
                    echo
                    '<li>
                        <a href="profile.php">'.$user_session->username.'</a>
                    </li>';
                    echo
                    '<li>
                    <form method="post" action="./">
                        <input type="hidden" name="logout"/>
                        <button type="submit" class="btn btn-default btn-md" style="margin-top: 13px; margin-right: 15px">Logout</button>
                    </form>
                    </li>';
                }

                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Your Favorite Source of Images</h1>
            <hr>
            <p>420px is a photo community for discovering and sharing inspiring photography! Showcase your work, discover amazing photos, and stay inspired.</p>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">Get Started</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about" style="padding: 70px!important">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center">
                <h2 class="section-heading">Show your photography skills!</h2>
                <hr class="light">
                <p class="text-faded">Share your best photos and get exposure!</p>
                <?php
                if (isset($_SESSION['user']))
                    echo '<a href="profile.php#upload-photos" class="btn btn-default btn-xl"><i class="fa fa-lg wow bounceIn fa-camera"></i> &nbsp;&nbsp; Start uploading</a>';
                else
                    echo '<a href="#log-in" class="page-scroll btn btn-default btn-xl"><i class="fa fa-lg wow bounceIn fa-camera"></i> &nbsp;&nbsp; Start uploading</a>';
                ?>
            </div>
            <div class="col-lg-6 col-md-6 text-center" style="border-left: solid 1px #ccc">
                <h2 class="section-heading">Search for inspiring photos!</h2>
                <hr class="light">
                <p class="text-faded">Find the perfect free photos in 420px!</p>
                <a href="search.php" class="btn btn-default btn-xl"><i class="fa fa-lg fa-search wow bounceIn"></i> &nbsp;&nbsp; Start searching</a>
            </div>
        </div>
    </div>
</section>

<section class="no-padding" id="portfolio" style="padding-top: 50px">
    <div class="container-fluid">
        <div class="row no-gutter">
            <?php include "dataAccess/global-photos.php"; ?>
        </div>
    </div>
</section>

<?php include 'views/footer.php'; ?>
