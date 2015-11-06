<?php 

include 'models/classes.php';
session_start();
include 'dataAccess/bdd.php';
include "dataAccess/log-in.php";
include "dataAccess/sign-up.php";

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ./');
}

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($_GET['img']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['img']))) {
    try {
        $req = $bdd->prepare('UPDATE image SET img_views = img_views + 1 WHERE image.id_image = ?');
        $req->execute(array(htmlspecialchars($_GET['img'])));
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    try {
        $req = $bdd->prepare('SELECT * FROM image INNER JOIN user ON img_user_id = id_user LEFT JOIN album ON img_album = id_album WHERE id_image = ?');
        $req->execute(array(htmlspecialchars($_GET['img'])));
        if ($req->rowCount() == 0) {
            header('Location: ./');
        }
        else {
            $donnees = $req->fetch();
            $user_get = new User($donnees['id_user'], $donnees['usr_email'], $donnees['usr_firstname'], $donnees['usr_lastname'], $donnees['usr_username'], $donnees['usr_creation_dt']);
            $image_get = new Image($donnees['id_image'], $donnees['img_title'], $donnees['img_description'], $donnees['img_type'], $donnees['img_img'], $donnees['img_filter'], $donnees['img_text'], $donnees['id_user'], $donnees['img_update_dt'], $donnees['img_views']);
            if (isset($donnees['id_album']))
                $album_get = new Album($donnees['id_album'], $donnees['alb_name'], $donnees['alb_cover'], $donnees['alb_user_id'], $donnees['alb_creation_dt']);
            try {
                $req = $bdd->prepare('SELECT id_image FROM image INNER JOIN user ON img_user_id = id_user WHERE id_user = ?');
                $req->execute(array($user_get->id));
                $user_get_nb_pics = $req->rowCount();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}
else header('Location: ./');

$user_to_show = $user_get;

try {
    $req = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
    $req->execute(array($user_to_show->id));
    if ($req->rowCount() > 0) {
        $donnees = $req->fetch();
        $usr_nb_views = $donnees['usr_views'];
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}

include 'dataAccess/delete-photo.php';
include 'dataAccess/add-comment.php';

?>