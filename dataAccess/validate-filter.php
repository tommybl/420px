<?php

include '../models/classes.php';
session_start();
include './bdd.php';

if (isset($_SESSION['user'])) $user_session = unserialize($_SESSION['user']);

if (isset($_GET['img']) && preg_match("/^([0-9])+$/", htmlspecialchars($_GET['img']))) {
    $id_photo = htmlspecialchars($_GET['img']);
    if (isset($_GET['filter'])) {
        $tmp_img_filter = htmlspecialchars($_GET['filter']);
        if (!is_valid_filter($tmp_img_filter)) header('Location: ../image.php?img='.$id_photo);
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
                $imagick = new Imagick();
                $tmp_img = $req->fetch();
                $tmp_img_ext = $tmp_img['img_type'];
                header('Content-type: '.$tmp_img['img_type']);
                $tmp_img = $tmp_img['img_img'];
                $imagick->readImageBlob($tmp_img);
                if ($tmp_img_ext != "image/gif") $imagick->setImageColorspace (imagick::COLORSPACE_RGB);
                if (isset($tmp_img_filter) && $tmp_img_filter == "more-contrast") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->contrastImage(1);
                            $frame->contrastImage(1);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->contrastImage(1);
                        $imagick->contrastImage(1);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "less-contrast") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->contrastImage(0);
                            $frame->contrastImage(0);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->contrastImage(0);
                        $imagick->contrastImage(0);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "more-brightness") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(150, 100, 100);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(150, 100, 100);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "less-brightness") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->colorizeImage('#000000', 0.5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->colorizeImage('#000000', 0.5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "grayscale") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(100, 0, 100);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(100, 0, 100);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "sepia") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->sepiaToneImage(90);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->sepiaToneImage(90);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "gaussian") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->gaussianBlurImage(10, 3);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->gaussianBlurImage(10, 3);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "more-saturation") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(100, 200, 100);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(100, 200, 100);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "less-saturation") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(100, 40, 100);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(100, 40, 100);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "more-hue") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(100, 100, 150);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(100, 100, 150);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "less-hue") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->modulateImage(100, 100, 50);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->modulateImage(100, 100, 50);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "colored-paint") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->adaptiveThresholdImage(30, 30, 0.05);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->adaptiveThresholdImage(30, 30, 0.05);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "more-noise") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->addNoiseImage(6);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->addNoiseImage(6);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "less-noise") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->reduceNoiseImage(6);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->reduceNoiseImage(6);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "dark-paint") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->blackthresholdimage("rgb(130, 130, 130)");
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->blackthresholdimage("rgb(130, 130, 130)");
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "charcoal") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->charcoalImage(1, 4);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->charcoalImage(1, 4);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "colorize") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->colorizeImage("rgb(".rand(0, 255).", ".rand(0, 255).", ".rand(0, 255).")", 1);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->colorizeImage("rgb(".rand(0, 255).", ".rand(0, 255).", ".rand(0, 255).")", 1);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "dark-edge") {
                    if ($tmp_img_ext == "image/gif") {
                        $edgeFindingKernel = [-1, -1, -1, -1, 8, -1, -1, -1, -1,];
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->convolveImage($edgeFindingKernel);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $edgeFindingKernel = [-1, -1, -1, -1, 8, -1, -1, -1, -1,];
                        $imagick->convolveImage($edgeFindingKernel);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "bright-paint") {
                    if ($tmp_img_ext == "image/gif") {
                        $edgeFindingKernel = [-1, -1, -1, -1, 11, -1, -1, -1, -1,];
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->convolveImage($edgeFindingKernel);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $edgeFindingKernel = [-1, -1, -1, -1, 11, -1, -1, -1, -1,];
                        $imagick->convolveImage($edgeFindingKernel);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "emboss") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->embossImage(2, 5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->embossImage(2, 5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "flip") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->flipImage();
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->flipImage();
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "flop") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->flopImage();
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->flopImage();
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "frame") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->frameImage("rgb(127, 127, 127)", 10, 10, 5, 5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->frameImage("rgb(127, 127, 127)", 10, 10, 5, 5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "negate") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->negateImage(false);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->negateImage(false);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "oil-paint") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->oilPaintImage(5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->oilPaintImage(5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "radial") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->radialBlurImage(3);
                            $frame->radialBlurImage(5);
                            $imagick->radialBlurImage(7);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->radialBlurImage(3);
                        $imagick->radialBlurImage(5);
                        $imagick->radialBlurImage(7);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "shade") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->shadeImage(true, 45, 20);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->shadeImage(true, 45, 20);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "sketch") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->sketchimage(10, 5, 45);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->sketchimage(10, 5, 45);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "spread") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->spreadImage(5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->spreadImage(5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "swrill") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->swirlImage(100);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->swirlImage(100);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "vignette") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->vignetteImage(10, 10, 10, 10);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->vignetteImage(10, 10, 10, 10);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "multiply") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $texture = new Imagick();
                            $texture->readImageBlob($tmp_img);
                            $texture->scaleimage($imagick->getimagewidth() / 6, $imagick->getimageheight() / 6);
                            $frame = $frame->textureImage($texture);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $texture = new Imagick();
                        $texture->readImageBlob($tmp_img);
                        if ($tmp_img_ext == "image/jpeg") $texture->setImageColorspace (imagick::COLORSPACE_RGB);
                        else if ($tmp_img_ext == "image/gif") $texture->setImageColorspace (imagick::COLORSPACE_RGB);
                        $texture->scaleimage($imagick->getimagewidth() / 6, $imagick->getimageheight() / 6);
                        $imagick = $imagick->textureImage($texture);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "wave") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->waveImage(6, 30);
                            $frame->adaptiveResizeImage(420, 420);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->waveImage(6, 30);
                        $imagick->adaptiveResizeImage(420, 420);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "shear") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->shearimage("rgb(255, 255, 255", 20, 3);
                            $frame->adaptiveResizeImage(420, 420);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->shearimage("rgb(255, 255, 255", 20, 3);
                        $imagick->adaptiveResizeImage(420, 420);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "rotate-right") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->rotateimage("rgb(255, 255, 255)", 90);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->rotateimage("rgb(255, 255, 255)", 90);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "rotate-180") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->rotateimage("rgb(255, 255, 255)", 180);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->rotateimage("rgb(255, 255, 255)", 180);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "rotate-left") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->rotateimage("rgb(255, 255, 255)", 270);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->rotateimage("rgb(255, 255, 255)", 270);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "black-white") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->thresholdimage(53000);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->thresholdimage(53000);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "solorize") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->solarizeImage(20000);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->solarizeImage(20000);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "segment") {
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->segmentImage(1, 5, 5);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->segmentImage(1, 5, 5);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "adaptive") {
                    if ($tmp_img_ext == "image/gif") {
                        $adaptiveOffsetQuantum = intval(3000);
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->adaptiveThresholdImage(50, 20, $adaptiveOffsetQuantum);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $adaptiveOffsetQuantum = intval(3000);
                        $imagick->adaptiveThresholdImage(50, 20, $adaptiveOffsetQuantum);
                    }
                }
                else if (isset($tmp_img_filter) && $tmp_img_filter == "annotate") {
                    $draw = new ImagickDraw();
                    $draw->setStrokeColor("rgb(0, 0, 0)");
                    $draw->setFillColor("rgb(255, 255, 255)");
                    $draw->setStrokeWidth(1);
                    $draw->setFontSize(36);
                    $text = isset($_GET['text']) ? htmlspecialchars($_GET['text']) : "Imagick";
                    $text = explode(" ", $text);
                    $print = "";
                    $n = 0;
                    foreach($text as $word) {
                        $n += strlen($word);
                        if ($n >= 20) {
                            $print .= " \n";
                            $n = 0;
                            $print .= $word;
                        }
                        else $print .= " ".$word;
                    }
                    $draw->setFont("../fonts/coolvetica.ttf");
                    if ($tmp_img_ext == "image/gif") {
                        $ngif = $imagick->coalesceImages();
                        foreach ($ngif as $frame) {
                            $frame->setImageColorspace (imagick::COLORSPACE_RGB);
                            $frame->annotateimage($draw, 40, 40, 0, $print);
                            $frame->setImagePage(420, 420, 0, 0);
                        } 
                        $imagick = $ngif->deconstructImages();
                    }
                    else {
                        $imagick->annotateimage($draw, 40, 40, 0, $print);
                    }
                }
                $imagick->setImagePage(420, 420, 0, 0);
                $imagick = $imagick->getImagesBlob();
                try {
                    $req = $bdd->prepare('UPDATE image SET img_img = ?, img_filter = NULL, img_text = NULL WHERE image.id_image = ?');
                    $req->execute(array($imagick, $id_photo));
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