<?php 
    include 'controllers/albumCtrl.php';
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
                    if ($user_session->id == $album_get->user_id) {
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
                if (isset($user_session) && $user_session->id == $album_get->user_id)
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
                <h2 class="section-heading"><?php echo $album_get->name.' &nbsp; <span style="font-size: 16px!important; position: relative; bottom: 4px"><i class="fa fa-file-image-o"></i> <span id="album-nb-pics"></span></span><div class="image-get-author">by <a href="./profile.php?usr='.$user_to_show->id.'">'.$user_to_show->username.'</a> the <strong>'.$album_get->creation_dt.'</strong></div>'; ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="no-padding" id="user-photos" style="padding-top: 50px">
    <?php
        if (isset($tmp_del_img_succ))
            echo '<p class="bg-success text-center">Image successfully deleted</p>';
        else if (isset($tmp_del_img_err))
            echo '<p class="bg-danger text-center">Error while deleting the image</p>';
        else if (isset($tmp_del_img_unauth))
            echo '<p class="bg-danger text-center">This image is not yours to delete</p>';
    ?>
    <div class="container-fluid">
        <div class="row no-gutter">
            <?php include "dataAccess/album-photos.php"; ?>
        </div>
    </div>
</section>

<?php include 'views/footer.php'; ?>
