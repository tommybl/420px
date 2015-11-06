<?php 
    include 'controllers/usersCtrl.php';
    include 'views/header.php';
?>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">420px</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="./feeds/rss-xml.php" target="_blank"><i class="fa fa-rss-square fa-lg" style="color: #f05f40"></i> &nbsp; GLOBAL RSS</a>
                </li>
                <li>
                    <a href="./">Home</a>
                </li>

                <?php
                if (!isset($_SESSION['user'])) {
                    echo
                    '<li>
                    <a class="page-scroll" href="#log-in">Log in</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#sign-up">Sign up</a>
                    </li>';
                }
                ?>

                <li>
                    <a class="page-scroll" href="#contact">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="search.php">Search</a>
                </li>
                <li>
                    <a class="page-scroll" href="#" style="color: #f05f40!important">Users</a>
                </li>

                <?php

                if (isset($_SESSION['user'])) {
                    echo
                    '<li>
                        <a href="profile.php">'.$user_session->username.'</a>
                    </li>';
                    echo
                    '<li>
                    <form method="post" action="./">
                        <input type="hidden" name="logout"/>
                        <button type="submit" class="btn btn-default btn-md" style="margin-top: 13px; margin-right: 15px">Logout</button>
                    </form>
                    </li>';
                }

                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<section class="bg-primary" id="image-get" style="padding: 90px 0 15px 0!important">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <h2 class="section-heading"><i class="fa fa-lg fa-search wow bounceIn"></i> Search for users</h2>
                <hr class="light">
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Views</th>
                                <th>Creation</th>
                                <th>RSS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users_list as &$user_curr) {
                            echo '
                            <tr class="odd gradeX">
                                <td class="center"><a href="profile.php?usr='.$user_curr['id_user'].'">'.$user_curr['usr_username'].'</a></td>
                                <td class="center">'.$user_curr['usr_firstname'].'</td>
                                <td class="center">'.$user_curr['usr_lastname'].'</td>
                                <td class="center"><i class="fa fa-eye"></i> '.$user_curr['usr_views'].'</td>
                                <td class="center">'.$user_curr['usr_creation_dt'].'</td>
                                <td class="center"><a href="./feeds/rss-xml.php?usr='.$user_curr['id_user'].'" target="_blank"><i class="fa fa-rss-square" style="color: #f05f40"></i> user rss</a></td>
                            </tr> '; 
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php include 'views/footer.php'; ?>
