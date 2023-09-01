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
  <link rel="stylesheet" href="css/new.css" media="screen">
  <link rel="stylesheet" href="css/background.css">
  <link rel=" stylesheet" href="css/main.css" media="screen">

  <!-- <link rel="stylesheet" href="home/style.css"> -->
  <script src=" js/modernizr/modernizr.min.js">
  </script>
</head>

<body class="">

  <img class="bg-img" src="images/home.jpg">
  <div class="title-container" style="z-index: 5; position: absolute; right: 0; left: 0">
    <div class="logo-box">
      <!-- <h1 class="logo-title" align="">REPORTC</h1> -->
      <a href="index.php"><img id="logo-img" src="images/REPORTC-logo.png" alt="logo"></a>
    </div>
    <div class="school-box">

      <h1 class="school-name" align="center">Ashaiman Mandela School</h1>
    </div>
    <div class="portal-container">
      <a class="teacher-portal portal-link" href="index.php">Home</a>
      <a class="teacher-portal portal-link" href="teachers.php">Teachers</a>
      <a class="parent-portal portal-link" href="find-result.php">Students</a>
      <a class="parent-portal portal-link" href="parent.php">Parents</a>

    </div>
  </div>
  <div class="main-wrapper">

    <div class="login-bg-color bg-black-300">

      <div class="row">

        <div class="col-lg-12">
          <div style="height: 100vh; width: 100vw; background-color: rgba(0,0,0,0.65); position: absolute; z-index: 0">

          </div>
          <div class="content" style="margin: auto 10%; position: sticky;">
            <br></br>
            <br></br>
            <br></br>

            <h2>Welcome!</h2>
            <br></br>

            <h1 class="school-name" style="z-index: 2">Ashaiman Mandela School</h1>


            <br></br>

            <p class="school-message"> Discover Ashaiman Mandela School, a shining beacon of education in the heart of
              Lebanon zone 4,
              Ashaiman. Our school is dedicated to nurturing excellence and providing a caring atmosphere for students
              to thrive. Our devoted teachers employ interactive methods that ignite curiosity and promote critical
              thinking. With modern classrooms and labs on our campus, we ensure an optimal learning journey.

              Beyond academics, we offer diverse sports, clubs, and cultural activities for students to explore their
              passions. At Ashaiman Mandela School, we emphasize vital values such as respect and empathy, shaping
              responsible citizens for tomorrow.</p>

            <h2>For more details, don't hesitate to contact us</h2>

            <h2 class="school-info">Zone 4, Lebanon, Ashaiman</h2>
            <h2 class="school-info">Greater Accra, Ghana.</h2>
            <h2 class="school-info">0244818069 or 0243971566</h2>

            <br></br>
            <h3> Join us in crafting a brighter future together!</h3>
          </div>
          <p class="text-muted text-center"><small>Copyright © 2023 REPORTC</small></p>
        </div>
        <!-- /.col-md-6 col-md-offset-3 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /. -->

  </div>
  <!-- /.main-wrapper -->

  <!-- ========== COMMON JS FILES ========== -->
  <script src=" js/jquery/jquery-2.2.4.min.js">
  </script>
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