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
        $zip = new ZipArchive();
        $now_dt = time();
        $filename = "./tmp/images".$now_dt.".zip";
        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("Error while creating the zip file\n");
        }
        $i = 1;
        foreach ($tmp_user_images as &$tmp_img) {
            $imagick = new Imagick();
            if ($tmp_img['img_type'] == 'image/jpeg') $tmp_img_ext = 'jpg';
            else if ($tmp_img['img_type'] == 'image/png') $tmp_img_ext = 'png';
            else $tmp_img_ext = 'gif';
            $tmp_img = $tmp_img['img_img'];
            $zip->addFromString('image'.$i.'.'.$tmp_img_ext, $tmp_img);
            $i += 1;
        }
        $zip->close();
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="images.zip"');
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