<?php 
    include 'controllers/profileCtrl.php';
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
                    <a class="page-scroll" href="#user-photos">Explore <span id="user-nb-pics-top"></span> pics</a>
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
                    if (!isset($user_get)) {
                        echo
                        '<li>
                            <a href="profile.php" style="color: #f05f40!important">'.$user_session->username.'</a>
                        </li>
                        <li>
                            <a href="feeds.php">Feeds</a>
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
                &nbsp;<span id="user-nb-pics"></span> photos
                &nbsp; <a href=<?php echo '"./feeds/rss-xml.php?usr='.$user_to_show->id.'"'; ?> class="profile-user-rss" target="_blank"><i class="fa fa-rss-square fa-lg"></i> rss</a>
                <?php
                if (isset($user_session) && !isset($user_get))
                    echo '&nbsp; <a class="profile-user-zip" href="./datas/zip.php" target="_blank"><i class="fa fa-file-zip-o fa-lg"></i> zip</a>
                          &nbsp; <a class="profile-user-zip" href="./datas/gif.php" target="_blank"><i class="fa fa-file-image-o fa-lg"></i> gif</a>' ;
                if (isset($user_session) && isset($user_get))
                    if ($tmp_following)
                        echo '&nbsp; <a class="profile-user-zip" href="" style="color: white!important"><i class="fa fa-thumbs-up fa-lg"></i> following</a>' ;
                    else 
                        echo '&nbsp; <a class="profile-user-zip" href="./dataAccess/follow.php?usr='.$user_to_show->id.'"><i class="fa fa-user-plus fa-lg"></i> follow</a>' ;
                ?>
                &nbsp; <span><i class="fa fa-eye fa-lg"></i> <?php echo $usr_nb_views ?></span>
            </div>

            <a href="#user-photos" class="btn btn-primary btn-xl page-scroll">See photos</a>
        </div>
    </div>
</header>

<?php
if (!isset($user_get)) {
    echo '
    <section class="bg-primary" id="upload-photos" style="padding: 40px!important">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                    <h2 class="section-heading"><i class="fa fa-lg fa-camera wow bounceIn"></i> Upload a photo</h2>
                    <hr class="light">';
                    if (isset($tmp_upload_succ)) echo $tmp_upload_succ;
                    if (isset($tmp_upload_err)) echo $tmp_upload_err;
              echo '<form action="profile.php#upload-photos" method="POST" enctype="multipart/form-data" id="form-upload-photo">
                        <input type="text" class="form-control no-radius-bottom no-border-bottom" name="title" placeholder="Enter a title" required>
                        <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="description" placeholder="Enter a description" required>
                        <input type="file" class="form-control no-radius-top padding-top-7" name="image" accept="image/*" required>
                        <input type="hidden" class="form-control" name="upload-photo" required><br>
                        <div class="modal fade modal-chose-album" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lg fa-folder-open wow bounceIn"></i> Chose an album</h4>
                              </div>
                              <div class="modal-body" style="background-color: rgba(30, 30, 30, 0.9)">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="chose-album" id="chose-album1" value="option1" checked>
                                    No album
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="chose-album" id="chose-album2" value="option2">
                                    Create new album
                                  </label><br><br>
                                  <input type="text" class="form-control" name="album-name" placeholder="Enter a new album name"><br>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="chose-album" id="ochose-album3" value="option3">
                                    Chose an existing album
                                  </label><br><br>
                                  <select name="album-id" class="form-control" form="form-upload-photo">';
                                  foreach ($albums_list as $tmp_album) echo '<option value="'.$tmp_album->id.'">'.$tmp_album->name.'</option>';
                            echo '</select>
                                </div>
                              </div>
                              <div class="modal-footer" style="text-align: right!important">
                                <button type="submit" class="btn btn-default btn-lg">Upload the photo</button>
                              </div>
                          </div>
                        </div>
                        <span class="btn btn-default btn-lg" data-toggle="modal" data-target=".modal-chose-album">Upload the photo</span>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 text-center" style="border-left: solid 1px #ccc">
                    <h2 class="section-heading"><i class="fa fa-lg fa-search wow bounceIn"></i> Search for photos</h2>
                    <hr class="light">
                    <form action="search.php" method="GET">
                        <input type="hidden" class="form-control" name="search-photo" required>
                        <input type="text" class="form-control no-radius-bottom no-border-bottom" name="query" placeholder="Enter key words">
                        <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="username" placeholder="And/Or enter a username">
                        <input type="text" class="form-control no-radius-top padding-top-7 jsColor" name="color" placeholder="And/Or pick a color">
                        <br>
                        <button type="submit" class="btn btn-default btn-lg">Search for photos</button>
                    </form>
                </div>
            </div>
        </div>
    </section>';
}
?>

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
            <?php include "dataAccess/user-photos.php"; ?>
        </div>
    </div>
</section>

<section class="bg-primary" id="user-albums" style="padding: 20px!important; margin-top: 50px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h2 class="section-heading" style="margin: 0"><i class="fa fa-lg fa-folder-open wow bounceIn"></i> Albums <span id="nb-albums">0</span></h2>
            </div>
        </div>
    </div>
</section>

<section class="no-padding">
    <div class="container-fluid">
        <div class="row no-gutter">
            <?php include "dataAccess/user-albums.php"; ?>
        </div>
    </div>
</section>

<section class="bg-primary" id="user-favorites" style="padding: 20px!important; margin-top: 50px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h2 class="section-heading" style="margin: 0"><i class="fa fa-lg fa-heart wow bounceIn"></i> Favorites <span id="nb-favorites">0</span></h2>
            </div>
        </div>
    </div>
</section>

<section class="no-padding">
    <div class="container-fluid">
        <div class="row no-gutter">
            <?php include "dataAccess/user-favorites.php"; ?>
        </div>
    </div>
</section>

<?php include 'views/footer.php'; ?>
