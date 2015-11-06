<!DOCTYPE html>

<?php

if (!isset($_SESSION['user'])) {
    echo
    '<section id="services" style="padding-bottom: 0">
        <div class="container">
            <div class="row">
                <div id="log-in" class="col-lg-6 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sign-in wow bounceIn text-primary"></i>
                        <h3>Log in</h3><br>';
                        if (isset($tmp_log_err)) echo $tmp_log_err;
                  echo '<form action="#log-in" method="POST">
                          <input type="email" class="form-control no-radius-bottom no-border-bottom" name="email" placeholder="Enter email" required>
                          <input type="password" class="form-control no-radius-top padding-top-7" name="password" placeholder="Enter password" required>
                          <input type="hidden" class="form-control" name="log-in" required><br>
                          <button type="submit" class="btn btn-primary btn-xl">Log in</button>
                        </form>
                    </div>
                </div>
                <div id="sign-up" class="col-lg-6 col-md-6 text-center" style="border-left: solid 1px #ccc">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user-plus wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Sign up</h3><br>';
                        if (isset($tmp_sign_err)) echo $tmp_sign_err;
                        if (isset($tmp_sign_succ)) echo $tmp_sign_succ;
                  echo '<form action="#sign-up" method="POST">
                          <input type="email" class="form-control no-radius-bottom no-border-bottom" name="email" placeholder="Enter email" required>
                          <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="username" placeholder="Enter username" required>
                          <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="firstname" placeholder="Enter firstname" required>
                          <input type="text" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="lastname" placeholder="Enter lastname" required>
                          <input type="password" class="form-control no-radius-top no-radius-bottom padding-top-7 no-border-bottom" name="password" placeholder="Enter password" required>
                          <input type="password" class="form-control no-radius-top padding-top-7" name="password2" placeholder="Enter password again" required>
                          <input type="hidden" class="form-control" name="sign-up" required><br>
                          <button type="submit" class="btn btn-primary btn-xl">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>';
}

?>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading"><strong>&copy; 420PX - TOMMY LOPES - MTI EPITA 2016</strong></h2>
            </div>
        </div>
    </div>
</section>

<footer></footer>
<section class="bg-primary" style="padding: 35px 0 35px 0!important"></section>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery.fittext.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jscolor/jscolor.js"></script>

<!-- DataTables JavaScript -->
<script src="bower/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/creative.js"></script>

</body>

</html>