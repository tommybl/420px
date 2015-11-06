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

$users_list = array();
try {
    $req = $bdd->prepare('SELECT * FROM user');
    $req->execute(array());
    if ($req->rowCount() > 0) {
        $users_list = $req->fetchAll();
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}

?>