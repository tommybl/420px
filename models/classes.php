<?php

class User
{
    public $email;
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $creation_dt;
    public $images;

    public function User($id, $email, $firstname, $lastname, $username, $creation_dt) // une méthode
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->creation_dt = $creation_dt;
    }
}

class Image
{
    public $id;
    public $title;
    public $description;
    public $type;
    public $img;
    public $filter;
    public $text;
    public $user_id;
    public $update_dt;
    public $views;

    public function Image($id, $title, $description, $type, $img, $filter, $text, $user_id, $update_dt, $views) // une méthode
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->img = $img;
        $this->filter = $filter;
        $this->text = $text;
        $this->user_id = $user_id;
        $this->update_dt = $update_dt;
        $this->views = $views;
    }
}

class Album
{
    public $id;
    public $name;
    public $cover;
    public $user_id;
    public $creation_dt;

    public function Album($id, $name, $cover, $user_id, $creation_dt) // une méthode
    {
        $this->id = $id;
        $this->name = $name;
        $this->cover = $cover;
        $this->user_id = $user_id;
        $this->creation_dt = $creation_dt;
    }
}

function is_valid_filter($tmp_img_filter) // une méthode
{
    if ($tmp_img_filter == "more-contrast" || $tmp_img_filter == "less-contrast" || $tmp_img_filter == "more-brightness" || $tmp_img_filter == "less-brightness" || $tmp_img_filter == "grayscale" || $tmp_img_filter == "sepia" || $tmp_img_filter == "gaussian" || $tmp_img_filter == "more-saturation" || $tmp_img_filter == "less-saturation" || $tmp_img_filter == "more-hue" || $tmp_img_filter == "less-hue" || $tmp_img_filter == "colored-paint" || $tmp_img_filter == "more-noise" || $tmp_img_filter == "less-noise" || $tmp_img_filter == "dark-paint" || $tmp_img_filter == "charcoal" || $tmp_img_filter == "colorize" || $tmp_img_filter == "dark-edge" || $tmp_img_filter == "bright-paint" || $tmp_img_filter == "emboss" || $tmp_img_filter == "flip" || $tmp_img_filter == "flop" || $tmp_img_filter == "frame" || $tmp_img_filter == "negate" || $tmp_img_filter == "oil-paint" || $tmp_img_filter == "radial" || $tmp_img_filter == "shade" || $tmp_img_filter == "sketch" || $tmp_img_filter == "spread" || $tmp_img_filter == "swrill" || $tmp_img_filter == "vignette" || $tmp_img_filter == "multiply" || $tmp_img_filter == "wave" || $tmp_img_filter == "shear" || $tmp_img_filter == "rotate-right" || $tmp_img_filter == "rotate-180" || $tmp_img_filter == "rotate-left" || $tmp_img_filter == "black-white" || $tmp_img_filter == "solorize" || $tmp_img_filter == "segment" || $tmp_img_filter == "adaptive" || $tmp_img_filter == "annotate")
        return true;
    return false;
}

?>