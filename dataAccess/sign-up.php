<?php

if (isset($_POST['sign-up'])) {
    if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        if (!empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($username)) {
            if (!preg_match("#^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$#", $email)) {
                $tmp_sign_err = '<p class="bg-danger">Bad email format</p>';
            }
            else if (strlen($email) >= 256) {
                $tmp_sign_err = '<p class="bg-danger">Email can\'t have more than 255 caracters</p>';
            }
            else if (strlen($username) >= 31 || strlen($username) < 2) {
                $tmp_sign_err = '<p class="bg-danger">Username can\'t have less than 2 and more than 30 caracters</p>';
            }
            else if (strlen($firstname) >= 31 || strlen($firstname) < 2) {
                $tmp_sign_err = '<p class="bg-danger">Firstname can\'t have less than 2 and more than 30 caracters</p>';
            }
            else if (strlen($lastname) >= 31 || strlen($lastname) < 2) {
                $tmp_sign_err = '<p class="bg-danger">Lastname can\'t have less than 2 and more than 30 caracters</p>';
            }
            else if (strlen($password) < 6) {
                $tmp_sign_err = '<p class="bg-danger">Password must have 6 caracters or more</p>';
            }
            else if ($password != $password2) {
                $tmp_sign_err = '<p class="bg-danger">The 2 password must be identical</p>';
            }
            else {
                try {
                    $req = $bdd->prepare('SELECT * FROM user WHERE usr_email = ? OR usr_username = ?');
                    $req->execute(array($email, $username));
                    if ($req->rowCount() > 0) {
                        $donnees = $req->fetch();
                        if ($donnees['usr_email'] == $email)
                            $tmp_sign_err = '<p class="bg-danger">Email address already used by another user</p>';
                        else if ($donnees['usr_username'] == $username)
                            $tmp_sign_err = '<p class="bg-danger">Username already used by another user</p>';
                    }
                    else {
                        $password = hash('sha256', $password);
                        $creation = (new \DateTime())->format('Y-m-d H:i:s');
                        try {
                            $req = $bdd->prepare('INSERT INTO user(usr_email, usr_username, usr_password, usr_firstname, usr_lastname, usr_creation_dt)
                                                  VALUES(:usr_email, :usr_username, :usr_password, :usr_firstname, :usr_lastname, :usr_creation_dt)');
                            $req->execute(array(
                                'usr_email' => $email,
                                'usr_username' => $username,
                                'usr_password' => $password,
                                'usr_firstname' => $firstname,
                                'usr_lastname' => $lastname,
                                'usr_creation_dt' => $creation
                                ));
                            $tmp_sign_succ = '<p class="bg-success">Account successfully created. You can log in</p>';
                        }
                        catch(Exception $e)
                        {
                            $tmp_sign_err = '<p class="bg-danger">A problem has occured while requesting database</p>';
                            echo $e->getMessage();
                        }
                    }
                }
                catch(Exception $e)
                {
                    $tmp_sign_err = '<p class="bg-danger">A problem has occured while requesting database</p>';
                    echo $e->getMessage();
                }
            }
        }
        else {
            $tmp_sign_err = '<p class="bg-danger">Please enter all user account informations to register</p>';
        }
    }
    else {
        $tmp_sign_err = '<p class="bg-danger">Please enter all user account informations to register</p>';
    }
}

?>