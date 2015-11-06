<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=420px;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>