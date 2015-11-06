<?php

try {
    $req = $bdd->prepare('SELECT * FROM image INNER JOIN user ON image.img_user_id = user.id_user ORDER BY image.img_update_dt DESC');
    $req->execute();
    if ($req->rowCount() == 0) {
        echo '<p class="bg-danger text-center">No images found on the server</p>';
    }
    else {
        echo '<script type="text/javascript">document.getElementById("global-nb-pics").innerHTML = "'.$req->rowCount().'";</script>';
        $tmp_user_images = $req->fetchAll();
        foreach ($tmp_user_images as &$tmp_img) {
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
catch(Exception $e)
{
    echo '<p class="bg-danger">A problem has occured while requesting database</p>';
    echo $e->getMessage();
}

?>