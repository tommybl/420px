<?php

echo '<script type="text/javascript">document.getElementById("nb-albums").innerHTML = "'.count($albums_list).'";</script>';
foreach ($albums_list as &$tmp_alb) {
    $tmp_alb_nb_pic = 0;
    try {
        $req = $bdd->prepare('SELECT id_image FROM image WHERE img_album = ?');
        $req->execute(array($tmp_alb->id));
        $tmp_alb_nb_pic = $req->rowCount();
    }
    catch(Exception $e) {}

    echo 
    '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
        <div class="portfolio-box" onClick="window.location.href=\'./album.php?alb='.$tmp_alb->id.'\';">
            <img src="./datas/images.php?img='.$tmp_alb->cover.'" class="img-responsive" alt="">
            <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                    <div class="project-name">
                        '.$tmp_alb->name.'
                    </div>
                    <div class="photo-details">
                        <a href="" data-toggle="tooltip" data-placement="top" title="Photos"><i class="fa fa-file-image-o fa-lg"> '.$tmp_alb_nb_pic.'</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

?>