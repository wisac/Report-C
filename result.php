<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ashaiman Mandela School | Results</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css" media="screen"> -->

  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
  <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
  <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
  <link rel="stylesheet" href="css/prism/prism.css" media="screen">
  <link rel="stylesheet" href="css/main.css" media="screen">
  <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body>
  <div class="main-wrapper">
    <div class="content-wrapper">
      <div class="content-container">


        <!-- /.left-sidebar -->

        <div class="main-page">
          <div class="container-fluid">
            <div class="row page-title-div">
              <div class="col-md-12">
                <h1 class="title" align="center">Ashaiman Mandela School</h1>
                <h3 class="title" align="center">0244818069/0243971566</h3>
                <h4 align="center">
                  <u><b>
                      Terminal Progress Report
                    </b></u>
                </h4>




              </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->

          <section class="section">
            <div class="container-fluid">

              <div class="row">



                <div class="col-md-8 col-md-offset-2">
                  <div class="panel">
                    <div class="panel-heading">
                      <div class="panel-title"
                        style="display: flex; justify-content: space-between; padding-left: 20px; padding-right: 20px">
                        <?php

                                                $rollid = $_POST['rollid'];
                                                $classid = $_POST['class'];
                                                $_SESSION['rollid'] = $rollid;
                                                $_SESSION['classid'] = $classid;
                                                $qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
                                                $stmt = $dbh->prepare($qery);
                                                $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($resultss as $row) { ?>
                        <div style="">
                          <p><b>Student Name :</b>
                            <?php echo htmlentities($row->StudentName); ?>
                          </p>
                          <p><b>Student ID :</b>
                            <?php echo htmlentities($row->RollId); ?>
                          <p><b>Student Class:</b>
                            <?php echo htmlentities($row->ClassName); ?>(
                            <?php echo htmlentities($row->Section); ?>)
                            <?php }

                                                    ?>
                        </div>
                        <img src="images/crest.png" style=" height: 100px; display: inline" alt=" logo">
                      </div>

                      <div class=" panel-body p-20">







                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Subject</th>
                              <th>Marks</th>
                            </tr>
                          </thead>




                          <tbody>
                            <?php
                                                            // Code for result
                                                        
                                                            $query = "select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                                            $query = $dbh->prepare($query);
                                                            $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                            $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                
                                                            if ($countrow = $query->rowCount() > 0) {

                                                                foreach ($results as $result) {

                                                                    ?>

                            <tr>
                              <th scope="row">
                                <?php echo htmlentities($cnt); ?>
                              </th>
                              <td>
                                <?php echo htmlentities($result->SubjectName); ?>
                              </td>
                              <td>
                                <?php echo htmlentities($totalmarks = $result->marks); ?>
                              </td>
                            </tr>
                            <?php
                                                                    $totlcount += $totalmarks;
                                                                    $cnt++;
                                                                }
                                                                ?>
                            <tr>
                              <th scope="row" colspan="2">Total Marks</th>
                              <td><b>
                                  <?php echo htmlentities($totlcount); ?>
                                </b> out of <b>
                                  <?php echo htmlentities($outof = ($cnt - 1) * 100); ?>
                                </b></td>
                            </tr>
                            <tr>
                              <th scope="row" colspan="2">Overall percntage</th>
                              <td><b>
                                  <?php echo htmlentities(round($totlcount * (100) / $outof)); ?>
                                  %
                                </b></td>
                            </tr>



                            <tr>
                              <th scope="row" colspan="2">Overall Grade</th>
                              <?php ?>
                              <td><b>
                                  <?php
                                  $percent = $totlcount * (100) / $outof;
                                //   echo htmlentities(round($percent)); for testing grading
                                  
                                                                            if ($percent >= '80')
                                                                                echo htmlentities("A");
                                                                            else if ($percent >= '70')
                                                                                echo htmlentities("B");
                                                                                else if ($percent >= '60')
                                                                                echo htmlentities("C");
                                                                                else if ($percent >= '50')
                                                                                echo htmlentities("D");
                                                                                else if ($percent >= '40')
                                                                                echo htmlentities("E");
                                                                            else
                                                                                echo htmlentities("F");
                                                                            
                                                                            ?>

                                </b></td>

                            </tr>

                            <?php } else { ?>
                            <div class="alert alert-warning left-icon-alert" role="alert">
                              <strong>Notice!</strong> Your result not declare yet
                              <?php }
                                                            ?>
                            </div>
                            <?php
                                                } else { ?>

                            <div class="alert alert-danger left-icon-alert" role="alert">
                              <strong>Sorry, Your ID was not found in the selected class. Please enter the correct
                                ID
                                and select the correct class!</strong>
                              <?php
                                                                echo htmlentities("");
                                                }
                                                ?>
                            </div>



                          </tbody>
                        </table>

                      </div>
                    </div>
                    <!-- /.panel -->
                  </div>
                  <!-- /.col-md-6 -->

                  <div class="form-group">

                    <div class="col-sm-6" style="">
                      <a href=" index.php">Back to Home</a>
                      <button onclick="window.print()" class=" btn btn-success ml-30" id="print">Print</button>
                    </div>
                  </div>

                </div>
                <!-- /.row -->

              </div>
              <!-- /.container-fluid -->
          </section>
          <!-- /.section -->

        </div>
        <!-- /.main-page -->


      </div>
      <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /.main-wrapper -->

  <!-- ========== COMMON JS FILES ========== -->
  <script src="js/jquery/jquery-2.2.4.min.js"></script>
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script src="js/lobipanel/lobipanel.min.js"></script>
  <script src="js/iscroll/iscroll.js"></script>

  <!-- ========== PAGE JS FILES ========== -->
  <script src="js/prism/prism.js"></script>

  <!-- ========== THEME JS ========== -->
  <script src="js/main.js"></script>
  <script>
  $(function($) {

  });
  </script>

  <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>

</html>