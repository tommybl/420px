<?php

include '../models/classes.php';
include '../dataAccess/bdd.php';

if (isset($_GET['usr']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['usr']))) {
    $tmp_user_id = htmlspecialchars($_GET['usr']);
    try {
        $req = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $req->execute(array($tmp_user_id));
        if ($req->rowCount() == 0) {
            echo '<p class="bg-danger text-center">Retrieving rss feed for this user has failed</p>';
        }
        else {
            $user_infos = $req->fetch();
            try {
                $req = $bdd->prepare('SELECT * FROM image INNER JOIN user ON image.img_user_id = user.id_user WHERE image.img_user_id = ? ORDER BY image.img_update_dt DESC');
                $req->execute(array($tmp_user_id));
                header('Content-Type: text/xml');
                $xml = '<?xml version="1.0" encoding="UTF-8"?>';
                $xml .= '<rss version="2.0">';
                $xml .= '<channel>';
                $xml .= ' <title>420px RSS feed - User '.$user_infos['usr_username'].'</title>';
                $xml .= ' <link>http://'.$_SERVER['HTTP_HOST'].'/420px/profile.php?usr='.$user_infos['id_user'].'</link>';
                $xml .= ' <description>RSS feed of user '.$user_infos['usr_firstname'].' '.$user_infos['usr_lastname'].' with '.$req->rowCount().' images</description>';
                $xml .= ' <language>en</language>';
                $xml .= ' <pubDate>'.date('r', time()).'</pubDate>';
                $xml .= ' <lastBuildDate>'.date('r', time()).'</lastBuildDate>';
                $xml .= ' <copyright>(C) 420PX - TOMMY LOPES - MTI EPITA 2016</copyright>';
                $xml .= ' <generator>PHP/MySQL</generator>';
                $tmp_user_images = $req->fetchAll();
                foreach ($tmp_user_images as &$tmp_img) {
                    $xml .= ' <item>';
                    $xml .= '  <title>'.$tmp_img['img_title'].' - '.$user_infos['usr_username'].'</title>';
                    $xml .= '  <link>http://'.$_SERVER['HTTP_HOST'].'/420px/image.php?img='.$tmp_img['id_image'].'</link> ';
                    $xml .= '  <description><![CDATA[ '.$tmp_img['img_description'].' <br> <a href="http://'.$_SERVER['HTTP_HOST'].'/420px/datas/images.php?img='.$tmp_img['id_image'].'">Lien vers l\'image</a> <br> <img src="http://'.$_SERVER['HTTP_HOST'].'/420px/datas/images.php?img='.$tmp_img['id_image'].'"> ]]></description>';
                    $xml .= ' </item>';
                }
                $xml .= '</channel>';
                $xml .= '</rss>';
                echo $xml;
            }
            catch(Exception $e)
            {
                echo '<p class="bg-danger text-center">Retrieving rss feed for this user has failed</p>';
                echo $e->getMessage();
            }
        }
    }
    catch(Exception $e)
    {
        echo '<p class="bg-danger text-center">Retrieving rss feed for this user has failed</p>';
        echo $e->getMessage();
    }
}
else if (!isset($_GET['usr'])) {
    try {
        $req = $bdd->prepare('SELECT * FROM image INNER JOIN user ON image.img_user_id = user.id_user ORDER BY image.img_update_dt DESC');
        $req->execute();
        header('Content-Type: text/xml');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0">';
        $xml .= '<channel>';
        $xml .= ' <title>420px global RSS feed</title>';
        $xml .= ' <link>http://'.$_SERVER['HTTP_HOST'].'/420px/</link>';
        $xml .= ' <description>RSS feed of last published 420px images</description>';
        $xml .= ' <language>en</language>';
        $xml .= ' <pubDate>'.date('r', time()).'</pubDate>';
        $xml .= ' <lastBuildDate>'.date('r', time()).'</lastBuildDate>';
        $xml .= ' <copyright>(C) 420PX - TOMMY LOPES - MTI EPITA 2016</copyright>';
        $xml .= ' <generator>PHP/MySQL</generator>';
        $tmp_user_images = $req->fetchAll();
        foreach ($tmp_user_images as &$tmp_img) {
            $xml .= ' <item>';
            $xml .= '  <title>'.$tmp_img['img_title'].' - '.$tmp_img['usr_username'].'</title>';
            $xml .= '  <link>http://'.$_SERVER['HTTP_HOST'].'/420px/image.php?img='.$tmp_img['id_image'].'</link> ';
            $xml .= '  <description><![CDATA[ '.$tmp_img['img_description'].' <br> <a href="http://'.$_SERVER['HTTP_HOST'].'/420px/datas/images.php?img='.$tmp_img['id_image'].'">Lien vers l\'image</a> <br> <img src="http://'.$_SERVER['HTTP_HOST'].'/420px/datas/images.php?img='.$tmp_img['id_image'].'"> ]]></description>';
            $xml .= ' </item>';
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        echo $xml;
    }
    catch(Exception $e)
    {
        echo '<p class="bg-danger text-center">Retrieving rss feed for this user has failed</p>';
        echo $e->getMessage();
    }
}
else echo '<p class="bg-danger text-center">Retrieving rss feed for this user has failed</p>';

?>