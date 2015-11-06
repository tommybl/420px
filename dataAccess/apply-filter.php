<?php

include '../models/classes.php';
session_start();
include './bdd.php';

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($_GET['img']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['img']))) {
    $id_photo = htmlspecialchars($_GET['img']);
    if (isset($_GET['filter'])) {
        $img_filter = htmlspecialchars($_GET['filter']);
        if (!is_valid_filter($img_filter)) header('Location: ../image.php?img='.$id_photo);
    }
    else header('Location: ../image.php?img='.$id_photo);
    if (isset($_SESSION['user'])) {
        try {
            $req = $bdd->prepare('SELECT * FROM image WHERE image.id_image = ? AND image.img_user_id = ?');
            $req->execute(array($id_photo, $user_session->id));
            if ($req->rowCount() == 0) {
                header('Location: ../image.php?img='.$id_photo);
            }
            else {
                if ($img_filter == "annotate") {
                    if (isset($_GET['text'])) $img_text = htmlspecialchars($_GET['text']);
                    else $img_text = $user_session->username;
                }
                else $img_text = null;
                try {
                    $req = $bdd->prepare('UPDATE image SET img_filter = ?, img_text = ? WHERE image.id_image = ?');
                    $req->execute(array($img_filter, $img_text, $id_photo));
                    header('Location: ../image.php?img='.$id_photo);
                }
                catch(Exception $e)
                {
                    header('Location: ../image.php?img='.$id_photo);
                    echo $e->getMessage();
                }
            }
        }
        catch(Exception $e)
        {
            header('Location: ../image.php?img='.$id_photo);
            echo $e->getMessage();
        }
    }
    else {
        header('Location: ../image.php?img='.$id_photo);
    }
}
else header('Location: ../index.php');

?>