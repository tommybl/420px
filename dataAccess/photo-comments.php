
<?php

$tmp_img_nb_heart = 0;
try {
    $req = $bdd->prepare('SELECT id_heart FROM heart WHERE heart_img_id = ?');
    $req->execute(array($image_get->id));
    $tmp_img_nb_heart = $req->rowCount();
}
catch(Exception $e) {}

try {
    $req = $bdd->prepare('SELECT * FROM comment INNER JOIN user ON id_user = com_usr_id WHERE com_img_id = ? ORDER BY com_creation_dt');
    $req->execute(array($image_get->id));
    $tmp_photo_nb_com = $req->rowCount();

?>

<div class="titleBox" id="title-comments-box">
    <label>&nbsp;<i class="fa fa-comments"></i> <?php echo $tmp_photo_nb_com; ?>
        &nbsp; <i class="fa fa-eye"></i> <?php echo $image_get->views; ?>
        &nbsp; <i class="fa fa-heart"></i> <?php echo $tmp_img_nb_heart; ?>
        &nbsp; <div class="fb-share-button" data-href=<?php echo '"./image.php?img='.$image_get->id.'#image-get"'; ?> data-layout="button_count" style="display: inline"></div>
        &nbsp; <span style="position: relative; top: 6px"><div class="g-plus" data-action="share" data-annotation="bubble" data-href=<?php echo '"./image.php?img='.$image_get->id.'#image-get"'; ?>  style="display: inline-block"></div></span>
        &nbsp;
        <span style="position: relative; top: 5px"><a href="//fr.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-color="red"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a></span>
    </label>
</div>
<div class="actionBox" id="action-comments-box">
    <ul class="commentList" id="list-comments-box">

<?php

    if ($req->rowCount() == 0) {
        echo '
            <li>
                <div class="commentText">
                    <p class="">No comments yet</p>
                </div>
            </li>
        ';
    }
    $tmp_image_comments = $req->fetchAll();
    foreach ($tmp_image_comments as &$tmp_com) {
        echo '
            <li>
                <div class="commenterImage">'.$tmp_com['usr_firstname'][0].$tmp_com['usr_lastname'][0].'</div>
                <div class="commentText">
                    <p class="">'.$tmp_com['com_com'].'</p> <span class="date sub-text">on '.$tmp_com['com_creation_dt'].' by <a href="./profile.php?usr='.$tmp_com['id_user'].'">'.$tmp_com['usr_username'].'</a></span>
                </div>
            </li>
        ';
    }
}
catch(Exception $e)
{
    echo '<p class="bg-danger">A problem has occured while requesting database</p>';
    echo $e->getMessage();
}

?>

</ul>
    <form class="form-inline" role="form" id="form-comments-box" action=<?php echo '"image.php?img='.$image_get->id.'#comments-row"'; ?> method="POST" style="padding-top: 10px">
        <?php if (isset($user_session)) echo '
        <input type="hidden" name="add-comment" />
        <input type="hidden" name="photo-id" value="'.$image_get->id.'" />
        <input class="form-control" type="text" name="comment" placeholder="Write a comment" style="width: 70%"/> &nbsp;
        <button class="btn btn-primary btn-sm" style="border-radius: 2px"><i class="fa fa-comment"> add</i></button>'; ?>
    </form>
</div>