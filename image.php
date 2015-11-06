<?php 
    include 'controllers/imageCtrl.php';
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
                    <a href="./">Home</a>
                </li>
                <li>
                    <a class="page-scroll" href=<?php echo '"./profile.php?usr='.$user_to_show->id.'#user-photos"'; ?> >Explore <?php echo $user_get_nb_pics; ?> pics</a>
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
                    if ($user_session->id == $image_get->user_id) {
                        echo
                        '<li>
                            <a href="profile.php" style="color: #f05f40!important">'.$user_session->username.'</a>
                        </li>';
                    }
                    else {
                        echo
                        '<li>
                            <a href="profile.php" >'.$user_session->username.'</a>
                        </li>';
                    }
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

<header class="header-profile">
    <div class="header-content">
        <div class="header-content-inner">
            <h1><?php echo $user_to_show->username; ?></h1>
            <hr>
            <div>
                <?php echo $user_to_show->firstname.' '.$user_to_show->lastname; ?> &nbsp;<i class="fa fa-chevron-circle-right"></i>
                &nbsp;<?php echo $user_get_nb_pics; ?> photos
                &nbsp; <a href=<?php echo '"./feeds/rss-xml.php?usr='.$user_to_show->id.'"'; ?> class="profile-user-rss" target="_blank"><i class="fa fa-rss-square" ></i> rss</a>
                <?php
                if (isset($user_session) && $user_session->id == $image_get->user_id)
                    echo '&nbsp; <a class="profile-user-zip" href="./datas/zip.php" target="_blank"><i class="fa fa-file-zip-o fa-lg"></i> zip</a>
                          &nbsp; <a class="profile-user-zip" href="./datas/gif.php" target="_blank"><i class="fa fa-file-image-o fa-lg"></i> gif</a>' ;
                ?>
                &nbsp; <span><i class="fa fa-eye fa-lg"></i> <?php echo $usr_nb_views ?></span>
            </div>

            <a href=<?php echo '"./profile.php?usr='.$user_to_show->id.'#user-photos"'; ?> class="btn btn-primary btn-xl page-scroll">See photos</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="image-get" style="padding: 20px 0 15px 0!important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <h2 class="section-heading"><?php echo $image_get->title.'<div class="image-get-author">'.(isset($album_get) ? 'in <a href="./album.php?alb='.$album_get->id.'">'.$album_get->name.'</a> ' : '').'by <a href="./profile.php?usr='.$user_to_show->id.'">'.$user_to_show->username.'</a> the <strong>'.$image_get->update_dt.'</strong></div>'; ?></h2>
                <p class="text-faded" style="font-weight: bold"><?php echo $image_get->description; ?></p>
                <?php if (isset($user_session) && $user_session->id == $image_get->user_id) echo '
                <form class="form-inline" action="profile.php#user-photos" method="POST" style="margin-top: -10px; display: inline">
                    <input type="hidden" class="form-control" name="photo-id" value="'.$image_get->id.'" required>
                    <input type="hidden" class="form-control" name="delete-photo" required>
                    <button type="submit" class="btn btn-default btn-md btn-actions"><i class="fa fa-times fa-lg"></i> Delete</button>
                </form>&nbsp;'; ?>
                <form action=<?php echo '"./datas/download.php?img='.$image_get->id.'"'; ?> method="POST" target="_blank" style="display: inline">
                    <button type="submit" class="btn btn-default btn-md btn-actions" ><i class="fa fa-download fa-lg"></i> Download</button>
                </form>&nbsp;
                <form action=<?php if (isset($user_session)) echo '"./dataAccess/add-heart.php?img='.$image_get->id.'"'; else echo '"./image.php#log-in"'; ?> method="GET" style="display: inline">
                    <input type="hidden" name="img" value=<?php echo '"'.$image_get->id.'"'; ?> />
                    <button type="submit" class="btn btn-default btn-md btn-actions" ><i class="fa fa-heart fa-lg"></i> Favorite</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="row" id="comments-row">
    <?php
        if (isset($tmp_del_img_succ))
            echo '<p class="bg-success text-center">Image successfully deleted</p>';
        else if (isset($tmp_del_img_err))
            echo '<p class="bg-danger text-center">Error while deleting the image</p>';
        else if (isset($tmp_del_img_unauth))
            echo '<p class="bg-danger text-center">This image is not yours to delete</p>';
        if (isset($tmp_add_com_err))
            echo '<p class="bg-danger text-center">Error while adding the comment</p>';
        else if (isset($tmp_add_com_unauth))
            echo '<p class="bg-danger text-center">You have to log in to comment</p>';
    ?>
    <div id="photo-to-show" class=<?php echo '"col-lg-4 col-md-4 col-sm-4'.((!isset($user_session) || $user_session->id != $image_get->user_id || $image_get->filter == null) ? ' col-lg-offset-2 col-md-offset-2 col-sm-offset-2' : '').'"'; ?> style="padding: 0 5px">
        <?php echo '<img src="data:'.$image_get->type.';base64,'.base64_encode($image_get->img).'" class="img-responsive" alt="">' ?>
    </div>
    <?php if (isset($user_session) && $user_session->id == $image_get->user_id && $image_get->filter != null) echo '
    <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 0 5px">
        <div class="portfolio-box" onClick="window.location.href=\'./dataAccess/validate-filter.php?img='.$image_get->id.'&filter='.$image_get->filter.'&text='.$image_get->text.'\'">
            <img src="datas/images.php?img='.$image_get->id.'&filter='.$image_get->filter.'&text='.$image_get->text.'" class="img-responsive" alt="">
            <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                    <div class="project-name">
                        '.$image_get->filter.'
                    </div>
                </div>
            </div>
        </div>
    </div>'; ?>
    <div class="col-lg-4 col-md-4 col-sm-4" id="comments-col" style="padding: 0 15px 0 5px; height: 100%">
        <div class="detailBox" id="comments-box">
            <?php include "./dataAccess/photo-comments.php"; ?>
        </div>
    </div>
</div>

<?php if (isset($user_session) && $user_session->id == $image_get->user_id) include "views/filters.php"; ?>

<section class="bg-primary" style="padding: 19px 0 19px 0!important"></section>

<?php include 'views/footer.php'; ?>
