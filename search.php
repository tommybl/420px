<?php 
    include 'controllers/searchCtrl.php';
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
                <li>
                    <a href="./feeds/rss-xml.php" target="_blank"><i class="fa fa-rss-square fa-lg" style="color: #f05f40"></i> &nbsp; GLOBAL RSS</a>
                </li>
                <li>
                    <a href="./">Home</a>
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
                    <a class="page-scroll" href="#" style="color: #f05f40!important">Search</a>
                </li>
                <li>
                    <a class="page-scroll" href="users.php" >Users</a>
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

<section class="bg-primary" id="image-get" style="padding: 90px 0 30px 0!important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <h2 class="section-heading"><i class="fa fa-lg fa-search wow bounceIn"></i> Search for photos</h2>
                <hr class="light">
                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 text-center" style="margin: auto; float: none!important">
                    <form action="search.php" method="GET" style="text-align: center">
                        <input type="hidden" class="form-control" name="search-photo" required>
                        <input type="text" class="form-control no-radius-bottom no-border-bottom text-center" name="query" placeholder="Enter key words" value=<?php echo ((isset($_GET['query'])) ? '"'.htmlspecialchars($_GET['query']).'"' : '""'); ?>>
                        <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom text-center" name="username" placeholder="And/Or enter a username"  value=<?php echo ((isset($_GET['username'])) ? '"'.htmlspecialchars($_GET['username']).'"' : '""'); ?>>
                        <input type="text" class="form-control no-radius-top padding-top-7 text-center jsColor" name="color" placeholder="And/Or pick a color" value=<?php echo ((isset($_GET['color'])) ? '"'.htmlspecialchars($_GET['color']).'"' : '""'); ?>>
                        <br>
                        <button type="submit" class="btn btn-default btn-lg">Search for photos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="no-padding" id="portfolio" style="padding-top: 50px">
    <div class="container-fluid">
        <div class="row no-gutter">

<?php

try {
    $query_str = 'SELECT * FROM image INNER JOIN user ON image.img_user_id = user.id_user WHERE 1=1';
    if (isset($_GET['username']) && !empty($_GET['username'])) {
        $search_usr = addslashes(htmlspecialchars($_GET['username']));
        $query_str .= ' AND user.usr_username LIKE \'%'.$search_usr.'%\'';
    }
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        $search_query = addslashes(htmlspecialchars($_GET['query']));
        $search_query = explode(" ", $search_query);
        foreach ($search_query as $search_param) {
            $query_str .= ' AND (image.img_title LIKE \'%'.$search_param.'%\' OR image.img_description LIKE \'%'.$search_param.'%\')';
        }
    }
    $query_str .= ' ORDER BY image.img_update_dt DESC';
    $req = $bdd->prepare($query_str);
    $req->execute();
    if ($req->rowCount() == 0) {
        echo '<p class="bg-danger text-center">No images found on the server</p>';
    }
    else {
        echo '<script type="text/javascript">document.getElementById("global-nb-pics").innerHTML = "'.$req->rowCount().'";</script>';
        $tmp_user_images = $req->fetchAll();
        if (isset($_GET['color']) && !empty($_GET['color'])) {
            $search_color_tmp = htmlspecialchars($_GET['color']);
            if (preg_match("/^[0-9A-F][0-9A-F][0-9A-F][0-9A-F][0-9A-F][0-9A-F]$/", $search_color_tmp))
                $search_color = new ImagickPixel('#'.$search_color_tmp);
        }
        foreach ($tmp_user_images as &$tmp_img) {
            $tmp_show_img = false;

            if (isset($search_color)) {
                $tmp_img_ext = $tmp_img['img_type'];
                $imagick = new Imagick();
                $imagick->readImageBlob($tmp_img['img_img']);
                if ($tmp_img_ext == "image/gif") {
                    $ngif = $imagick->coalesceImages();
                    foreach ($ngif as $frame) {
                        $imagick = clone $frame;
                        break;
                    }
                }
                if ($tmp_img_ext != "image/png") $imagick->setImageColorspace (imagick::COLORSPACE_RGB);
                $imagick->adaptiveResizeImage(4, 4);
                $imageIterator = $imagick->getPixelIterator();

                foreach ($imageIterator as $row => $pixels)
                {
                    foreach ($pixels as $column => $pixel)
                    {
                        $value = $imagick->getQuantumRange()['quantumRangeLong'] * 0.09;
                        if($pixel->isSimilar($search_color, $value))
                        {
                            $tmp_show_img = true;
                            break 2;
                        }
                    }
                    $imageIterator->syncIterator();
                }
            }
            else $tmp_show_img = true;

            if ($tmp_show_img) {
                $tmp_img_nb_com = 0;
                try {
                    $req = $bdd->prepare('SELECT id_comment FROM comment WHERE com_img_id = ?');
                    $req->execute(array($tmp_img['id_image']));
                    $tmp_img_nb_com = $req->rowCount();
                }
                catch(Exception $e) {}
                $tmp_img_nb_heart = 0;
                try {
                    $req = $bdd->prepare('SELECT id_heart FROM heart WHERE heart_img_id = ?');
                    $req->execute(array($tmp_img['id_image']));
                    $tmp_img_nb_heart = $req->rowCount();
                }
                catch(Exception $e) {}

                echo 
                '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                    <div class="portfolio-box" onClick="window.location.href=\'./image.php?img='.$tmp_img['id_image'].'\';">
                        <img src="data:'.$tmp_img['img_type'].';base64,'.base64_encode($tmp_img['img_img']).'" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-name">
                                    '.$tmp_img['img_title'].'
                                </div>
                                <div class="project-category text-faded">
                                    '.$tmp_img['img_description'].'
                                </div>
                                <div class="project-user text-faded">
                                    <a href="./profile.php?usr='.$tmp_img['img_user_id'].'">'.$tmp_img['usr_username'].' &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                                </div><br>
                                <a href="./image.php?img='.$tmp_img['id_image'].'" class="btn btn-default btn-md btn-actions" data-toggle="tooltip" data-placement="top" title="Detail and modify"><i class="fa fa-share-square-o fa-lg"></i></a>&nbsp;
                                <form action="./datas/download.php?img='.$tmp_img['id_image'].'" method="POST" target="_blank" style="display: inline">
                                    <button type="submit" class="btn btn-default btn-md btn-actions" data-toggle="tooltip" data-placement="top" title="Download"><i class="fa fa-download fa-lg"></i></button>
                                </form>
                                <div class="photo-details">
                                    <a href="./image.php?img='.$tmp_img['id_image'].'#comments-row" data-toggle="tooltip" data-placement="top" title="Comments"><i class="fa fa-comments fa-lg"> '.$tmp_img_nb_com.'</i></a>
                                    &nbsp;&nbsp;
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Views"><i class="fa fa-eye fa-lg"> '.$tmp_img['img_views'].'</i></a>
                                    &nbsp;&nbsp;
                                    <a href='.(isset($user_session) ? '"./dataAccess/add-heart.php?img='.$tmp_img['id_image'].'"' : '"./image.php?img='.$tmp_img['id_image'].'#log-in"').' data-toggle="tooltip" data-placement="top" title="Add to favorites"><i class="fa fa-heart fa-lg"> '.$tmp_img_nb_heart.'</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
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
    </div>
</section>

<?php include 'views/footer.php'; ?>
