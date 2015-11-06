<?php

include '../models/classes.php';
session_start();
include '../dataAccess/bdd.php';

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($user_session)) {
    try {
        $req = $bdd->prepare('SELECT * FROM image WHERE image.img_user_id = ?');
        $req->execute(array($user_session->id));
        $tmp_user_images = $req->fetchAll();
        $gif = new Imagick();
        $gif->setFormat("gif");
        $now_dt = time();
        $filename = dirname(__FILE__).'/tmp/images'.$now_dt.'.gif';
        foreach ($tmp_user_images as &$tmp_img) {
            $tmp_img_ext = $tmp_img['img_type'];
            $imagick = new Imagick();
            $tmp_img = $tmp_img['img_img'];
            $imagick->readImageBlob($tmp_img);
            $imagick->setImageColorspace (imagick::COLORSPACE_RGB);
            $gif->addImage($imagick); 
            $gif->setImageDelay(50);
        }
        $gif->setImageColorspace (imagick::COLORSPACE_RGB);
        $gif->writeImages($filename, true);
        header('Content-type: image/gif');
        header('Content-Disposition: attachment; filename="images.gif"');
        readfile($filename);
        unlink($filename);
    }
    catch(Exception $e)
    {
        echo '<p class="bg-danger">A problem has occured while requesting database</p>';
        echo $e->getMessage();
    }
}

?>