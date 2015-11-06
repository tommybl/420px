<?php

if (isset($_POST['upload-photo'])) {
    if (isset($_SESSION['user'])) {
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['image'])) {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $image = $_FILES['image'];
            if (!empty($title) && !empty($description) && !empty($image)) {
                if (strlen($title) >= 46 || strlen($title) < 2) {
                    $tmp_upload_err = '<p class="bg-danger">Image title can\'t have less than 2 and more than 45 caracters</p>';
                }
                else if (strlen($description) >= 256 || strlen($description) < 2) {
                    $tmp_upload_err = '<p class="bg-danger">Image description can\'t have less than 2 and more than 255 caracters</p>';
                }
                else if ($image['type'] != "image/png" && $image['type'] != "image/jpeg" && $image['type'] != "image/gif") {
                    $tmp_upload_err = '<p class="bg-danger">Image must be jpeg or png or gif</p>';
                }
                else if ($image['size'] > 10000000) {
                    $tmp_upload_err = '<p class="bg-danger">Image must be 10Mo maximum</p>';
                }
                else {
                    $album_id = null;
                    if (isset($_POST['chose-album'])) {
                        $album_opt = htmlspecialchars($_POST['chose-album']);
                        if ($album_opt == "option2") {
                            if (isset($_POST['album-name'])) {
                                $album_name = htmlspecialchars($_POST['album-name']);
                                try {
                                    $req = $bdd->prepare('INSERT INTO album(alb_user_id, alb_name)
                                                          VALUES(:alb_user_id, :alb_name)');
                                    $req->execute(array(
                                        'alb_user_id' => $user_session->id,
                                        'alb_name' => $album_name
                                        ));
                                    $album_id = $bdd->lastInsertId();
                                }
                                catch(Exception $e)
                                {
                                    echo $e->getMessage();
                                }
                            }
                        }
                        else if ($album_opt == "option3") {
                            if (isset($_POST['album-id'])) {
                                $tmp_album_id = htmlspecialchars($_POST['album-id']);
                                try {
                                    $req = $bdd->prepare('SELECT id_album FROM album WHERE id_album = ? AND alb_user_id = ?');
                                    $req->execute(array($tmp_album_id, $user_session->id));
                                    if ($req->rowCount() > 0) $album_id = $tmp_album_id;
                                }
                                catch(Exception $e)
                                {
                                    echo $e->getMessage();
                                }
                            }
                        }
                    }

                    $nimage = new Imagick($image['tmp_name']);
                    if ($image['type'] == "image/gif") {
                        $ngif = $nimage->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $width = $frame->getImageWidth();
                            $height = $frame->getImageHeight();
                            if ($width > $height) $frame->adaptiveResizeImage(0, 420);
                            else $frame->adaptiveResizeImage(420, 0);
                            $width = $frame->getImageWidth();
                            $height = $frame->getImageHeight();
                            $frame->cropImage(420, 420, ($width/2)-210, ($height/2)-210);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $ngif = $ngif->deconstructImages();
                        $nimage = $ngif->getImagesBlob();
                    }
                    else if ($image['type'] == "image/jpeg") {
                        $nimage->setImageColorspace (imagick::COLORSPACE_RGB);
                        $width = $nimage->getImageWidth();
                        $height = $nimage->getImageHeight();
                        if ($width > $height) $nimage->adaptiveResizeImage(0, 420);
                        else $nimage->adaptiveResizeImage(420, 0);
                        $width = $nimage->getImageWidth();
                        $height = $nimage->getImageHeight();
                        $nimage->cropImage(420, 420, ($width/2)-210, ($height/2)-210);
                        $nimage->setImagePage(420, 420, 0, 0);
                        $nimage = $nimage->getImageBlob();
                    }
                    else {
                        $width = $nimage->getImageWidth();
                        $height = $nimage->getImageHeight();
                        if ($width > $height) $nimage->adaptiveResizeImage(0, 420);
                        else $nimage->adaptiveResizeImage(420, 0);
                        $width = $nimage->getImageWidth();
                        $height = $nimage->getImageHeight();
                        $nimage->cropImage(420, 420, ($width/2)-210, ($height/2)-210);
                        $nimage->setImagePage(420, 420, 0, 0);
                        $nimage = $nimage->getImageBlob();
                    }
                    $creation = (new \DateTime())->format('Y-m-d H:i:s');
                    try {
                        $req = $bdd->prepare('INSERT INTO image(img_user_id, img_title, img_description, img_img, img_type, img_creation_dt, img_update_dt, img_album)
                                              VALUES(:img_user_id, :img_title, :img_description, :img_img, :img_type, :img_creation_dt, :img_update_dt, :img_album)');
                        $req->execute(array(
                            'img_user_id' => $user_session->id,
                            'img_title' => $title,
                            'img_description' => $description,
                            'img_img' => $nimage,
                            'img_type' => $image['type'],
                            'img_creation_dt' => $creation,
                            'img_update_dt' => $creation,
                            'img_album' => $album_id
                            ));
                        $tmp_upload_succ = '<p class="bg-success">Image successfully updated, you can see it in your photos below</p>';
                        $image_last_id = $bdd->lastInsertId();
                        if ($album_id != null) {
                            try {
                                $req = $bdd->prepare('UPDATE album SET alb_cover = ? WHERE id_album = ?');
                                $req->execute(array($image_last_id, $album_id));
                            }
                            catch(Exception $e)
                            {
                                echo $e->getMessage();
                            }
                        }
                        try {
                            $req = $bdd->prepare('INSERT INTO feed(feed_user_id, feed_img_id, feed_type)
                                                  VALUES(:feed_user_id, :feed_img_id, :feed_type)');
                            $req->execute(array(
                                'feed_user_id' => $user_session->id,
                                'feed_img_id' => $image_last_id,
                                'feed_type' => 'upload'
                                ));
                        }
                        catch(Exception $e)
                        {
                            echo $e->getMessage();
                        }
                    }
                    catch(Exception $e)
                    {
                        $tmp_upload_err = '<p class="bg-danger">A problem has occured while requesting database</p>';
                        echo $e->getMessage();
                    }
                }
            }
            else {
                $tmp_upload_err = '<p class="bg-danger">Please enter all image informations to upload</p>';
            }
        }
        else {
            $tmp_upload_err = '<p class="bg-danger">Please enter all image informations to upload</p>';
        }
    }
    else {
        $tmp_upload_err = '<p class="bg-danger">You must be logged in to uplaod images</p>';
    }
}

?>