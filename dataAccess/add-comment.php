<?php

if (isset($_POST['add-comment'])) {
    if (isset($_SESSION['user'])) {
        if (isset($_POST['photo-id']) && isset($_POST['comment'])) {
            $id_photo = htmlspecialchars($_POST['photo-id']);
            $photo_comment = htmlspecialchars($_POST['comment']);
            if (!preg_match("/^([0-9])+$/", $id_photo)) {
                $tmp_add_com_err = true;
            }
            else {
                try {
                    $creation = (new \DateTime())->format('Y-m-d H:i:s');
                    $req = $bdd->prepare('INSERT INTO comment(com_usr_id, com_img_id, com_com, com_creation_dt)
                                          VALUES(:com_usr_id, :com_img_id, :com_com, :com_creation_dt)');
                    $req->execute(array(
                        'com_usr_id' => $user_session->id,
                        'com_img_id' => $id_photo,
                        'com_com' => $photo_comment,
                        'com_creation_dt' => $creation
                    ));
                    $tmp_add_com_succ = true;
                    $com_last_id = $bdd->lastInsertId();
                    try {
                        $req = $bdd->prepare('INSERT INTO feed(feed_user_id, feed_img_id, feed_com_id, feed_type)
                                              VALUES(:feed_user_id, :feed_img_id, :feed_com_id, :feed_type)');
                        $req->execute(array(
                            'feed_user_id' => $user_session->id,
                            'feed_img_id' => $id_photo,
                            'feed_com_id' => $com_last_id,
                            'feed_type' => 'comment'
                            ));
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
                catch(Exception $e)
                {
                    $tmp_add_com_err = true;
                    echo $e->getMessage();
                }
            }
        }
        else {
            $tmp_add_com_err = true;
        }
    }
    else {
        $tmp_add_com_unauth = true;
    }
}

?>