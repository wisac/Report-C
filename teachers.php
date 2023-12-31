<?php
session_start();
error_reporting(0);
include 'includes/config.php';
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";
        echo "<script>window.history.go(-1);</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ReportC | Ashaiman Mandela School</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
  <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
  <link rel="stylesheet" href="css/background.css">
  <link rel="stylesheet" href="css/new.css" media="screen">
  <link rel="stylesheet" href="css/main.css" media="screen">
  <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body class="">
  <div class="bg-container">
    <img class=" bg-img teacher" src="images/teachers.jpg" alt="bg">
  </div>
  <div class="main-wrapper">


    <div class="">
      <div class="row">
        <div style="height: 100vh; width: 100vw; background-color: rgba(0,0,0,0.60); position: absolute; z-index: -1">

        </div>
        <div class="title-container" style="justify-content: padding: 2%">
          <div class=" logo-box">
            <!-- <h1 class="logo-title" align="">REPORTC</h1> -->
            <a href="index.php"><img id="logo-img" src="images/REPORTC-logo.png" alt="logo"></a>
          </div>
          <div class="school-box" style="display: block">

            <h1 class="school-name">Ashaiman Mandela School</h1>
          </div>
          <div class=" portal-container">
            <a class="teacher-portal portal-link" href="index.php">Home</a>
            <a class="teacher-portal portal-link" href="teachers.php">Teachers</a>
            <a class="parent-portal portal-link" href="find-result.php">Students</a>
            <a class="parent-portal portal-link" href="parent.php">Parents</a>

          </div>
        </div>

        <div class="col-lg-6" style="opacity: 100">
          <section class="section">
            <div class="row mt-40">
              <div class="col-md-10 col-md-offset-1 pt-50">

                <div class="row mt-30 ">
                  <div class="col-md-11">
                    <div class="panel">
                      <div class="panel-heading">
                        <div class="panel-title text-center">
                          <h4>Admin Login</h4>
                        </div>
                      </div>
                      <div class="panel-body p-20">

                        <div class="section-title">
                          <p class="sub-title">Student Result Management System
                          </p>
                        </div>

                        <form class="form-horizontal" method="post">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                              <input type="text" name="username" class="form-control" id="inputEmail3"
                                placeholder="Username">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" name="password" class="form-control" id="inputPassword3"
                                placeholder="Password">
                            </div>
                          </div>

                          <div class="form-group mt-20">
                            <div class="col-sm-offset-2 col-sm-10">

                              <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign
                                in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                            </div>
                          </div>
                        </form>




                      </div>
                    </div>
                    <!-- /.panel -->

                    </p>
                  </div>
                  <!-- /.col-md-11 -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
          </section>

        </div>
        <!-- /.col-lg-6 -->

        <!--Teachers Login-->

        <div class="col-lg-6 teacher-container" style="opacity: 90%">
          <section class="section">
            <div class="row mt-40">
              <div class="col-md-10 col-md-offset-1 pt-50">

                <div class="row mt-30 ">
                  <div class="col-md-11">
                    <div class="panel teacher-pannel">
                      <div class="panel-heading">
                        <div class="panel-title text-center">
                          <h4>Teachers Login</h4>
                        </div>
                      </div>
                      <div class="panel-body p-20">

                        <div class="section-title">
                          <p class="sub-title">Record student results and perfomances
                          </p>
                        </div>

                        <form class="form-horizontal" method="post">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                              <input type="text" name="username" class="form-control" id="inputEmail3"
                                placeholder="UserName">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" name="password" class="form-control" id="inputPassword3"
                                placeholder="Password">
                            </div>
                          </div>

                          <div class="form-group mt-20">
                            <div class="col-sm-offset-2 col-sm-10">

                              <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign
                                in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                            </div>
                          </div>
                        </form>




                      </div>
                    </div>
                    <!-- /.panel -->

                  </div>
                  <!-- /.col-md-11 -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
          </section>

        </div>

      </div>
      <!-- /.row -->
    </div>

    <!-- /. -->

  </div>
  <!-- /.main-wrapper -->

  <!-- ========== COMMON JS FILES ========== -->
  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/jquery-ui/jquery-ui.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script src="js/lobipanel/lobipanel.min.js"></script>
  <script src="js/iscroll/iscroll.js"></script>

  <!-- ========== PAGE JS FILES ========== -->

  <!-- ========== THEME JS ========== -->
  <script src="js/main.js"></script>
  <script>
  $(function() {

  });
  </script>

  <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>