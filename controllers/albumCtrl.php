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

if (isset($_GET['alb']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['alb']))) {
    try {
        $req = $bdd->prepare('SELECT * FROM album INNER JOIN user ON alb_user_id = id_user WHERE id_album = ?');
        $req->execute(array(htmlspecialchars($_GET['alb'])));
        if ($req->rowCount() == 0) {
            header('Location: ./profile.php');
        }
        else {
            $donnees = $req->fetch();
            $user_get = new User($donnees['id_user'], $donnees['usr_email'], $donnees['usr_firstname'], $donnees['usr_lastname'], $donnees['usr_username'], $donnees['usr_creation_dt']);
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