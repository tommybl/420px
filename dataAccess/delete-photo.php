<?php

if (isset($_POST['delete-photo'])) {
    if (isset($_SESSION['user'])) {
        if (isset($_POST['photo-id'])) {
            $id_photo = htmlspecialchars($_POST['photo-id']);
            if (!preg_match("/^([0-9])+$/", $id_photo)) {
                $tmp_del_img_err = true;
            }
            else {
                try {
                    $req = $bdd->prepare('SELECT * FROM image WHERE image.id_image = ? AND image.img_user_id = ?');
                    $req->execute(array($id_photo, $user_session->id));
                    if ($req->rowCount() == 0) {
                        $tmp_del_img_unauth = true;
                    }
                    else {
                        try {
                            $req = $bdd->prepare('DELETE FROM image WHERE image.id_image = ?');
                            $req->execute(array($id_photo));
                            $tmp_del_img_succ = true;
                        }
                        catch(Exception $e)
                        {
                            $tmp_del_img_err = true;
                            echo $e->getMessage();
                        }
                    }
                }
                catch(Exception $e)
                {
                    $tmp_del_img_err = true;
                    echo $e->getMessage();
                }
            }
        }
        else {
            $tmp_del_img_err = true;
        }
    }
    else {
        $tmp_del_img_unauth = true;
    }
}

?>