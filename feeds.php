<?php 
    include 'controllers/feedsCtrl.php';
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
                            <a href="profile.php">'.$user_session->username.'</a>
                        </li>
                        <li>
                            <a href="feeds.php" style="color: #f05f40!important">Feeds</a>
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

<section class="bg-primary" id="image-get" style="padding: 90px 0 15px 0!important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <h2 class="section-heading"><i class="fa fa-lg fa-thumbs-up wow bounceIn"></i> Followed feeds</h2>
                <hr class="light">
            </div>
        </div>
    </div>
</section>

<div class="row" style="margin-top: 30px">
    <div class="col-lg-12">

<?php

try {
    $req = $bdd->prepare('SELECT * FROM feed INNER JOIN follow ON feed_user_id = flw_followed INNER JOIN user ON flw_followed = id_user LEFT JOIN comment ON feed_com_id = id_comment LEFT JOIN image ON feed_img_id = id_image WHERE flw_follower = ? ORDER BY feed_creation_dt DESC');
    $req->execute(array($user_session->id));
    if ($req->rowCount() == 0) {
        echo '<p class="bg-danger text-center">No feeds found on your profile</p>';
    }
    else {
        $tmp_feeds = $req->fetchAll();
        foreach ($tmp_feeds as &$tmp_feed) {
            echo
            '<div class="row">
               <div class="col-lg-6" style="padding: 15px 50px; margin: auto; float: none">';

       if ($tmp_feed['feed_type'] == 'upload') {
            echo '<span><i class="fa fa-file-image-o fa-2x"></i> &nbsp; '.$tmp_feed['feed_creation_dt'].'</span><br>
             <p>The user <a href="./profile.php.usr='.$tmp_feed['id_user'].'">'.$tmp_feed['usr_username'].'</a> has <strong>upload</strong> a new photo.</p>
             <a href="./image.php?img='.$tmp_feed['id_image'].'"><img src="./datas/images.php?img='.$tmp_feed['id_image'].'" width="100" height="100" /></a><br>';
       }
       else if ($tmp_feed['feed_type'] == 'comment') {
            echo '<span><i class="fa fa-comment fa-2x"></i> &nbsp; '.$tmp_feed['feed_creation_dt'].'</span><br>
             <p>The user <a href="./profile.php.usr='.$tmp_feed['id_user'].'">'.$tmp_feed['usr_username'].'</a> has <strong>commented</strong> this photo.</p>
             <a href="./image.php?img='.$tmp_feed['id_image'].'"><img src="./datas/images.php?img='.$tmp_feed['id_image'].'" width="100" height="100" /></a><br><br>
             <strong >"'.$tmp_feed['com_com'].'"</strong><br>';
       }


         echo '<hr style="width: 50%!important; max-width: 50%!important"></div>
            </div>';
        }
    }
}
catch(Exception $e)
{
    echo '<p class="bg-danger">A problem has occured while requesting database</p>';
    echo $e->getMessage();
}

?>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php include 'views/footer.php'; ?>
