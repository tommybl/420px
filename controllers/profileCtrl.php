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

$usr_nb_views = 0;

if (isset($_GET['usr']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['usr']))) {
    try {
        $req = $bdd->prepare('UPDATE user SET usr_views = usr_views + 1 WHERE user.id_user = ?');
        $req->execute(array(htmlspecialchars($_GET['usr'])));
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    try {
        $req = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $req->execute(array(htmlspecialchars($_GET['usr'])));
        if ($req->rowCount() == 0) {
            header('Location: profile.php');
        }
        else {
            $donnees = $req->fetch();
            $usr_nb_views = $donnees['usr_views'];
            if (!isset($user_session) || ($user_session->id != $donnees['id_user']))
                $user_get = new User($donnees['id_user'], $donnees['usr_email'], $donnees['usr_firstname'], $donnees['usr_lastname'], $donnees['usr_username'], $donnees['usr_creation_dt']);
            else header('Location: profile.php');
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}
else if (isset($user_session)) {
    try {
        $req = $bdd->prepare('UPDATE user SET usr_views = usr_views + 1 WHERE user.id_user = ?');
        $req->execute(array($user_session->id));
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    try {
        $req = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $req->execute(array($user_session->id));
        if ($req->rowCount() > 0) {
            $donnees = $req->fetch();
            $usr_nb_views = $donnees['usr_views'];
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

if (!isset($_SESSION['user']) && !isset($user_get)) header('Location: ./#log-in');

$user_to_show = (isset($user_get)) ? $user_get : $user_session;

$albums_list = array();
try {
    $req = $bdd->prepare('SELECT * FROM album WHERE alb_user_id = ? ORDER BY alb_creation_dt DESC');
    $req->execute(array($user_to_show->id));
    if ($req->rowCount() > 0) {
        $donnees = $req->fetchAll();
        foreach ($donnees as $tmp_album) {
            $albums_list[] = new Album($tmp_album['id_album'], $tmp_album['alb_name'], $tmp_album['alb_cover'], $tmp_album['alb_user_id'], $tmp_album['alb_creation_dt']);
        }
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}

$tmp_following = false;
if (isset($user_session)) {
    try {
        $req = $bdd->prepare('SELECT id_follow FROM follow WHERE flw_followed = ? AND flw_follower = ?');
        $req->execute(array($user_to_show->id, $user_session->id));
        if ($req->rowCount() > 0) {
            $tmp_following = true;
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

include "dataAccess/upload-photo.php";
include 'dataAccess/delete-photo.php';

?>