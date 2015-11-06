<?php

include '../models/classes.php';
session_start();
include './bdd.php';

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($_SESSION['user'])) {
    if (isset($_GET['img'])) {
        $id_photo = htmlspecialchars($_GET['img']);
        if (!preg_match("/^([0-9])+$/", $id_photo)) {
            header('Location: ../profile.php#user-favorites');
        }
        else {
            try {
                $req = $bdd->prepare('SELECT id_heart FROM heart WHERE heart_img_id = ? AND heart_usr_id = ?');
                $req->execute(array($id_photo, $user_session->id));
                if ($req->rowCount() == 0) {
                    try {
                        $creation = (new \DateTime())->format('Y-m-d H:i:s');
                        $req = $bdd->prepare('INSERT INTO heart(heart_usr_id, heart_img_id, heart_creation_dt)
                                              VALUES(:heart_usr_id, :heart_img_id, :heart_creation_dt)');
                        $req->execute(array(
                            'heart_usr_id' => $user_session->id,
                            'heart_img_id' => $id_photo,
                            'heart_creation_dt' => $creation
                        ));
                        header('Location: ../profile.php#user-favorites');
                    }
                    catch(Exception $e)
                    {
                        header('Location: ../profile.php#user-favorites');
                        echo $e->getMessage();
                    }
                }
                else header('Location: ../profile.php#user-favorites');
            }
            catch(Exception $e)
            {
                header('Location: ../profile.php#user-favorites');
                echo $e->getMessage();
            }
        }
    }
    else {
        header('Location: ../profile.php#user-favorites');
    }
}
else {
    header('Location: ../profile.php#user-favorites');
}

?>