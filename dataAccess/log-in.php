<?php

if (isset($_POST['log-in'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($email) && !empty($password)) {
            try {
                $password = hash('sha256', $password);
                $req = $bdd->prepare('SELECT * FROM user WHERE usr_email = ? AND usr_password = ?');
                $req->execute(array($email, $password));
                if ($req->rowCount() == 0) {
                    $tmp_log_err = '<p class="bg-danger">No user account found with those email and password</p>';
                }
                else {
                    $donnees = $req->fetch();
                    $newuser = new User($donnees['id_user'], $email, $donnees['usr_firstname'], $donnees['usr_lastname'], $donnees['usr_username'], $donnees['usr_creation_dt']);
                    $_SESSION['user'] = serialize($newuser);
                    header('Location: profile.php');
                }
            }
            catch(Exception $e)
            {
                $tmp_log_err = '<p class="bg-danger">A problem has occured while requesting database</p>';
                echo $e->getMessage();
            }
        }
        else {
            $tmp_log_err = '<p class="bg-danger">Please enter both email and password to log in</p>';
        }
    }
    else {
        $tmp_log_err = '<p class="bg-danger">Please enter both email and password to log in</p>';
    }
}

?>