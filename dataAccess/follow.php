<?php

include '../models/classes.php';
session_start();
include './bdd.php';

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($_GET['usr']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['usr']))) {
    $id_usr = htmlspecialchars($_GET['usr']);
    if (isset($_SESSION['user'])) {
        try {
            $req = $bdd->prepare('SELECT id_user FROM user WHERE id_user = ?');
            $req->execute(array($id_usr));
            if ($req->rowCount() == 0) {
                header('Location: ../index.php');
            }
            else {
                try {
                    $req = $bdd->prepare('SELECT id_follow FROM follow WHERE flw_followed = ? AND flw_follower = ?');
                    $req->execute(array($id_usr, $user_session->id));
                    if ($req->rowCount() > 0) {
                        header('Location: ../profile.php?usr='.$id_usr);
                    }
                    else {
                        try {
                            $req = $bdd->prepare('INSERT INTO follow(flw_followed, flw_follower)
                                                  VALUES(:flw_followed, :flw_follower)');
                            $req->execute(array(
                                'flw_followed' => $id_usr,
                                'flw_follower' => $user_session->id
                                ));
                            header('Location: ../profile.php?usr='.$id_usr);
                        }
                        catch(Exception $e)
                        {
                            header('Location: ../profile.php?usr='.$id_usr);
                            echo $e->getMessage();
                        }
                    }
                }
                catch(Exception $e)
                {
                    header('Location: ../index.php');
                    echo $e->getMessage();
                }
            }
        }
        catch(Exception $e)
        {
            header('Location: ../index.php');
            echo $e->getMessage();
        }
    }
    else {
        header('Location: ../index.php');
    }
}
else header('Location: ../index.php');

?>