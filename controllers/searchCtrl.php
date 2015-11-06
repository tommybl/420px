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

?>