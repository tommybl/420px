<?php

include '../models/classes.php';
include '../dataAccess/bdd.php';

if (isset($_GET['img']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['img']))) {
    $tmp_img_id = htmlspecialchars($_GET['img']);
    try {
        $req = $bdd->prepare('SELECT * FROM image WHERE image.id_image = ?');
        $req->execute(array($tmp_img_id));
        if ($req->rowCount() == 0) {
            echo '<p class="bg-danger">Image not found</p>';
        }
        else {
            $imagick = new Imagick();
            $tmp_img = $req->fetch();
            if ($tmp_img['img_type'] == 'image/jpeg') $tmp_img_ext = 'jpg';
            else if ($tmp_img['img_type'] == 'image/png') $tmp_img_ext = 'png';
            else $tmp_img_ext = 'gif';
            header('Content-type: '.$tmp_img['img_type']);
            header('Content-Disposition: attachement; filename="image.'.$tmp_img_ext.'"');
            $tmp_img = $tmp_img['img_img'];
            echo $tmp_img;
        }
    }
    catch(Exception $e)
    {
        echo '<p class="bg-danger">A problem has occured while requesting database</p>';
        echo $e->getMessage();
    }
}

?>